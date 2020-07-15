<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function view(Request $request, $testid, $questionnumber){
        $user = auth()->user();
        $test=Test::where('refid', $testid)->where('user_id', $user->id)->firstOrFail();
        $questions=Question::where('chapter_id', $test->chapter_id)->orderBy('sequence_no', 'asc')->select('id','sequence_no')->get();

        foreach($questions as $q){

        }


        $chapter = $test->chapter;
        if ($user->isSubscriptionActive() && !empty($chapter->questions)) {
            if ($chapter->sequence_no <= $user->last_qualified_chapter) {
                $question=Question::where('chapter_id', $chapter->id)
                    ->where('sequence_no', $questionnumber)
                    ->firstOrFail();
                return view('website.question', compact('chapter', 'question','test','questions'));
            }
        }
        return abort(404);
    }


    public function putAnswer(Request $request,$testid, $questionnumber){
        $request->validate([
            'answer'=>'required|in:1,2,3,4'
        ]);

        $user = auth()->user();
        $test=Test::where('refid', $testid)->where('user_id', $user->id)->firstOrFail();
        $chapter = $test->chapter;
        if ($user->isSubscriptionActive() && !empty($chapter->questions)) {
            if ($chapter->sequence_no <= $user->last_qualified_chapter) {

                $question=Question::where('chapter_id', $chapter->id)
                    ->where('sequence_no', $questionnumber)
                    ->firstOrFail();
                //var_dump(count($chapter->questions));
                //var_dump($question->sequence_no);die;
                if($question->sequence_no < count($chapter->questions)){


                    $test->giveAnswer($question->sequence_no, $request->answer);
                    return redirect()->route('website.view.question', ['testid'=>$test->refid, 'questionid'=>$question->sequence_no+1]);
                }else{
                    return redirect()->route('website.test.submit', ['testid'=>$test->refid]);
                }
            }
        }
        return abort(404);


        $user=auth()->user();
        $test=Test::with('chapter')->where('user_id', $user->id)->where('refid', $request->test_id)->firstOrFail();
        $test->giveAnswer($request->question_no, $request->answer);
        return [
            'status'=>'success',
        ];
    }
}
