<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class ChapterController extends Controller
{
    public function index(Request $request){
        $chapters =Chapter::get();
        return view('siteadmin.chapter',['chapters'=>$chapters]);
    }
    public function create(Request $request){
        return view('siteadmin.chapteradd');
    }
    public function store(Request $request){

        $request->validate([
            'image'=>'image',

        ]);

        if(isset($request->image)){
            $file=$request->image->path();

            $name=str_replace(' ', '_', $request->image->getClientOriginalName());

            $path='chapters/'.$name;

            Storage::put($path, file_get_contents($file));
        }else{
            $path=null;
        }
        Chapter::create(['title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'isactive'=>$request->isactive,
            'sequence_no'=>$request->sequence_no]);

        return redirect(route('chapter.list'));
    }
    public function edit(Request $request,$id){
        $chapters =Chapter::find($id);
        return view('siteadmin.chapteredit',['chapters'=>$chapters]);
    }
    public function update(Request $request, $id){

        $request->validate([
            'image'=>'image',
        ]);

        $chapters=Chapter::findOrFail($id);
        if(isset($request->image)){
            $file=$request->image->path();

            $name=str_replace(' ', '_', $request->image->getClientOriginalName());

            $path='chapters/'.$name;

            Storage::put($path, file_get_contents($file));

            $chapters->update(['title' => $request->title,
                'description' => $request->description,
                'image' => $path,
                'isactive'=>$request->isactive,
                'sequence_no'=>$request->sequence_no]);

        }else{
            $chapters->update(['title' => $request->title,
                'description' => $request->description,
                'isactive'=>$request->isactive,
                'sequence_no'=>$request->sequence_no]);
        }

        return redirect(route('chapter.list'));
    }

}
