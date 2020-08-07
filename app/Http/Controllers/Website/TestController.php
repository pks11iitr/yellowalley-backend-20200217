<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Test;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestController extends Controller
{
    public function start(Request $request, $id)
    {
        $user = auth()->user();
        $chapter = Chapter::active()
            ->with(['questions'=>function($questions){
                $questions->orderBy('questions.sequence_no', 'asc')->where('questions.isactive', true);
                }])
            ->findOrFail($id);
        //var_dump($chapter->questions);die;
        if ($user->isSubscriptionActive() && count($chapter->questions)) {
            if ($chapter->sequence_no <= $user->last_qualified_chapter) {
                $testid = $chapter->startTest();
                if ($testid) {
                    return redirect()->route('website.view.question', ['testid'=>$testid, 'questionid'=>$chapter->questions[0]->sequence_no]);
                }
            }
        }
        return abort(404);
    }

    public function viewSubmitTest(Request $request, $testid){

        $user = auth()->user();
        $test=Test::where('refid', $testid)->where('user_id', $user->id)->firstOrFail();
        $chapter = $test->chapter;
        if ($user->isSubscriptionActive() && count($chapter->questions)) {
            if ($chapter->sequence_no <= $user->last_qualified_chapter) {
                return view('website.complete-test', compact('chapter','test'));
            }
        }
        return abort(404);

    }

    public function submitTest(Request $request, $testid){
        $user = auth()->user();
        $test = Test::with('chapter')->where('user_id', $user->id)->where('refid', $testid)->firstOrFail();
        $score = $test->setScore($user);
        $totalchapters = Chapter::active()->count();
        $result = [];
        if ($score['isqualify'] == 'yes')
            if ($user->last_qualified_chapter <= $test->chapter->sequence_no && $user->last_qualified_chapter < $totalchapters) {
                $user->qualifyForNextChapter($test->chapter->sequence_no + 1);
            }

//        if($user->last_qualified_chapter < $totalchapters && $test->chapter->sequence_no < $totalchapters)
//            $result['next_chapter_id']=$user->last_qualified_chapter;
//        else{
//            if($score['isqualify']=='yes')
//                $result['next_chapter_id']='completed';
//            else
//                $result['next_chapter_id']=$user->last_qualified_chapter;
//        }

        if($score['isqualify']=='yes'){
            if($test->chapter->sequence_no == $totalchapters)
                $result['next_chapter_id']='completed';
            else{
                if($test->chapter->sequence_no + 1 < $user->last_qualified_chapter)
                    $result['next_chapter_id']=$test->chapter->sequence_no+1;
                else
                    $result['next_chapter_id']=$user->last_qualified_chapter;
            }
        }else{
            $result['next_chapter_id']=$test->chapter->id;
        }

        if($result['next_chapter_id']!='completed') {
            $nextchaper = Chapter::active()->where('sequence_no', $result['next_chapter_id'])->firstOrFail();
            $result['next_chapter_id']="$nextchaper->id";
        }

        $result['totalscore']=$score['total'];
        $result['status']='success';
        $result['score']=$score['score'];
        $result['pass_status']=$score['isqualify'];
        return view('website.test-score',compact('result','test'));
    }

    public function getCertificateInfo(Request $request){

        $user=auth()->user();
        //var_dump($user);var_dump(Test::isAllTestComplete($user));die;
        if(Test::isAllTestComplete($user)){
            $result= [
                'status'=>'success',
                'message'=>'Click download button to continue',
                'url'=>route('website.certificate.download', ['code'=>$user->referral_code])
            ];
        }else{
            $result= [
                'status'=>'failed',
                'message'=>'Please complete all tests to download Certificate'
            ];
        }

        return view('website.certificate-information', compact('result','user'));
    }

    public function downloadCertificate(Request $request, $code){
        $user=User::where('referral_code', $code)->firstOrFail();
//        $score=$user->totalScore();
//        $totalscore=Score::totalscore();
        if(Test::isAllTestComplete($user)) {

            $img = Image::make(public_path('certificate.jpg'));
            $img->text(ucwords($user->name), 1200, 1200, function ($font) {
                $font->file(public_path('fonts.otf'));
                $font->size(100);
                $font->color('#000000');
                $font->align('center');
                $font->angle(0);
            });
            $img->text(date('d F, Y'), 800, 2150, function ($font) {
                $font->file(public_path('fonts.otf'));
                $font->size(80);
                $font->color('#000000');
                $font->align('center');
                $font->angle(0);
            });
            $img->save(public_path("uploads/certificates/".(str_replace(' ', '-', $user->name.'-'.$user->id)).".jpg"));

            return response()->download(public_path("uploads/certificates/".(str_replace(' ', '-', $user->name.'-'.$user->id)).".jpg"));

        }else{
            return redirect()->back()->with('error', 'Please complete all test to download certificate');
        }
    }

}
