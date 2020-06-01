<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function start(Request $request, $id)
    {
        $user = auth()->user();
        $chapter = Chapter::active()->with('questions')->findOrFail($id);
        //var_dump($chapter->questions);die;
        if ($user->isSubscriptionActive() && count($chapter->questions)) {
            if ($chapter->sequence_no <= $user->last_qualified_chapter) {
                $testid = $chapter->startTest();
                if ($testid) {
                    return redirect()->route('website.view.question', ['testid'=>$testid, 'questionid'=>$chapter->questions[0]->id]);
                }
            }
        }
        return abort(404);
    }

    public function submitTest(Request $request, $testid){

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
}
