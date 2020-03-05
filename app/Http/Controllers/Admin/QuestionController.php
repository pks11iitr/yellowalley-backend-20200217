<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chapter;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index(Request $request){
        $questions =Question::get();
        return view('siteadmin.question',['questions'=>$questions]);
    }
    public function create(Request $request){
        $chapters =Chapter::get();
        return view('siteadmin.questionadd',['chapters'=>$chapters]);
    }
    public function store(Request $request){
        Question::create($request->only(['question','option1','option2','option3','option4',
            'isactive','answer','chapter_id','sequence_no']));
        return redirect(route('question.list'))->with('success','Question has been created');
    }
    public function edit(Request $request,$id){
        $chapteredit =Question::find($id);
        $chapters =Chapter::get();
        return view('siteadmin.questionedit',['chapters'=>$chapters,'chapteredit'=>$chapteredit]);
    }
    public function update(Request $request,$id){
        $chapteredit =Question::find($id);
        $chapteredit->update($request->only(['question','option1','option2','option3','option4',
            'isactive','answer','chapter_id','sequence_no']));
        return redirect(route('question.list'))->with('success','Question has been updated');
    }
}
