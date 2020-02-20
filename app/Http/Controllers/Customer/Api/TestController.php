<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Chapter;
use App\Models\Score;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function start(Request $request, $id){
        $chapter=Chapter::active()->findOrFail($id);
        $testid=$chapter->startTest();
        if($testid){
            return [
                'status'=>'success',
                'data'=>[
                    'testid'=>$testid,
                    'questions_count'=>$chapter->questions()->count()
                ]
            ];
        }
        return [
            'status'=>'failed',
            'data'=>[]
        ];
    }


    public function getQuestion(Request $request){
        $request->validate([
            'test_id'=>'required|integer',
            'question_no'=>'required|integer'
        ]);
        $user=auth()->user();
        $test=Test::with('chapter')->where('user_id', $user->id)->where('refid', $request->test_id)->firstOrFail();
        $question=$test->getQuestion($request->question_no);
        return [
            'status'=>'success',
            'data'=>compact('question')
        ];
    }

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

    public function submitTest(Request $request){
        $request->validate([
            'test_id'=>'required|integer',
        ]);
        $user=auth()->user();
        $test=Test::where('user_id', $user->id)->where('refid', $request->test_id)->firstOrFail();
        $test->setScore();
        return [
            'status'=>'success'
        ];
    }
}
