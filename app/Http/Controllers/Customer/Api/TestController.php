<?php

namespace App\Http\Controllers\Customer\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Score;
use App\Models\Test;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestController extends Controller
{
    public function start(Request $request, $id)
    {
        $user = auth()->user();
        $chapter = Chapter::active()->with('questions')->findOrFail($id);
        if ($user->isSubscriptionActive()) {
            if ($chapter->sequence_no <= $user->last_qualified_chapter) {
                $testid = $chapter->startTest();
                if ($testid) {
                    return [
                        'status' => 'success',
                        'data' => [
                            'testid' => $testid,
                            'questions_count' => $chapter->questions()->count(),
                            'chapter'=>$chapter
                        ]
                    ];
                }
            }
        }
        return [
            'status' => 'failed',
            'data' => []
        ];
    }



//    public function getQuestion(Request $request){
//        $request->validate([
//            'test_id'=>'required|integer',
//            'question_no'=>'required|integer'
//        ]);
//        $user=auth()->user();
//        $test=Test::with('chapter')->where('user_id', $user->id)->where('refid', $request->test_id)->firstOrFail();
//        $question=$test->getQuestion($request->question_no);
//        return [
//            'status'=>'success',
//            'data'=>compact('question')
//        ];
//    }

    public function answer(Request $request){
        $request->validate([
            'test_id'=>'required|integer',
            'question_no'=>'required|integer',
            'answer'=>'required|in:1,2,3,4'
        ]);
        $user=auth()->user();
        $test=Test::with('chapter')->where('user_id', $user->id)->where('refid', $request->test_id)->firstOrFail();
        $test->giveAnswer($request->question_no, $request->answer);
        return [
            'status'=>'success',
        ];
    }

    public function submitTest(Request $request)
    {
        $request->validate([
            'test_id' => 'required|integer',
        ]);
        $user = auth()->user();
        $test = Test::with('chapter')->where('user_id', $user->id)->where('refid', $request->test_id)->firstOrFail();
        $score = $test->setScore($user);
        $totalchapters = Chapter::active()->count();
        $result = [];
        if ($score['isqualify'] == 'yes')
            if ($user->last_qualified_chapter <= $test->chapter->sequence_no && $user->last_qualified_chapter < $totalchapters) {
                $user->qualifyForNextChapter($test->chapter->sequence_no + 1);
                //$result['next_chapter_id'] = $user->last_qualified_chapter;
            }

//        if($user->last_qualified_chapter < $totalchapters && $test->chapter->sequence_no < $totalchapters)
//            $result['next_chapter_id']=$user->last_qualified_chapter;
//        else{
//            if($score['isqualify']=='yes')
//                $result['next_chapter_id']='completed';
//            else
//                $result['next_chapter_id']=$user->last_qualified_chapter;
//        }

//        if($score['isqualify']=='yes'){
//            if($test->chapter->sequence_no < $totalchapters)
//                $result['next_chapter_id']=$user->last_qualified_chapter;
//            else
//                $result['next_chapter_id']='completed';
//        }else{
//            $result['next_chapter_id']=$user->last_qualified_chapter;
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
        $result['chapter_name']=$test->chapter->title??'';
        $result['pass_status']=strtoupper($score['isqualify']);
        return $result;
    }


    public function getCertificateInfo(Request $request){

        $user=auth()->user();
        if(Test::isAllTestComplete($user)){
            return [
                'status'=>'success',
                'message'=>'Click download button to continue',
                'url'=>route('api.certificate.download', ['code'=>$user->referral_code])
            ];
        }

        return [
            'status'=>'failed',
            'message'=>'Please complete all tests to download Certificate'
        ];
    }


    public function downloadCertificate(Request $request, $code){
        $user=User::where('referral_code', $code)->firstOrFail();

        $score=$user->totalScore();
        $totalscore=Score::totalscore();
        $img = Image::make(public_path('certificate.jpg'));
        $img->text(ucwords($user->name), 1200, 1200, function($font) {
            $font->file(public_path('fonts.otf'));
            $font->size(100);
            $font->color('#000000');
            $font->align('center');
            $font->angle(0);
        });
        $img->text(date('d F, Y'), 800, 2150, function($font) {
            $font->file(public_path('fonts.otf'));
            $font->size(80);
            $font->color('#000000');
            $font->align('center');
            $font->angle(0);
        });
        $img->save(public_path("uploads/certificates/$code.jpg"));

        return response()->download(public_path("uploads/certificates/$code.jpg"));

    }
}
