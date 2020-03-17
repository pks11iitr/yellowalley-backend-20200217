<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Chapter;
use App\Models\Score;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                $result['next_chapter_id'] = $user->last_qualified_chapter;
            }

        if($user->last_qualified_chapter < $totalchapters && $test->chapter->sequence_no < $totalchapters)
            $result['next_chapter_id']=$user->last_qualified_chapter;
        else{
            $result['next_chapter_id']='completed';
        }




        $result['totalscore']=$score['total'];
        $result['status']='success';
        $result['score']=$score['score'];
        $result['pass_status']=$score['isqualify'];
        return $result;
    }


    public function downloadCertificate(Request $request){

        $user=auth()->user();
        if(Test::canDownloadCertificate($user)){

        }

        return [
            'status'=>'failed',
            'message'=>'Please complete all tests to download certificate'
        ];



    }
}
