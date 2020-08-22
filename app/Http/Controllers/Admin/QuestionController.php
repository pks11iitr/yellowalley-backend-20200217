<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request){
        $questions =Question::orderBy('chapter_id','asc')->orderBy('sequence_no','asc');

        if(isset($request->chapter))//die;
            $questions=$questions->where('chapter_id', $request->chapter);
        if(isset($request->search))
            $questions=$questions->where('question', 'like', "%".$request->search."%")
                ->orWhere('option1', 'like', "%".$request->search."%")
                ->orWhere('option2', 'like', "%".$request->search."%")
                ->orWhere('option3', 'like', "%".$request->search."%")
                ->orWhere('option4', 'like', "%".$request->search."%")
                ->orWhere('answer', 'like', "%".$request->search."%");
            $questions=$questions->paginate(5);

        $chapters=Chapter::active()->get();
        return view('siteadmin.question',['questions'=>$questions, 'chapters'=>$chapters]);
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
