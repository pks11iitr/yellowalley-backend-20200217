<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(Request $request){
        $videos =Video::get();
        return view('siteadmin.videolist',['videos'=>$videos]);
    }
    public function create(Request $request){
        $chapters =Chapter::get();
        return view('siteadmin.videoadd',['chapters'=>$chapters]);
    }
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image',
            'video_url' => 'required|mimes:mp4,mov,ogg,qt,flv,m3u8,ts,3gp,avi,wmv'

        ]);
        if (isset($request->image)) {
            $file = $request->image;


            $name = str_replace(' ', '_', $request->image->getClientOriginalName());

            $path = 'videos/' . $name;

            Storage::put($path, file_get_contents($file));

        } else {
            $path = null;
        }

        if (isset($request->video_url)) {
            $file2 = $request->video_url;


            $name2 = str_replace(' ', '_', $request->video_url->getClientOriginalName());

            $path2 = 'videos/' . $name2;

            Storage::put($path2, file_get_contents($file2));
        } else {
            $path2 = null;
        }

        Video::create(['name' => $request->name,
            'image' => $path,
            'video_url' => $path2,
            'isactive' => $request->isactive,
            'chapter_id' => $request->chapter_id,
            'description' => $request->description,
            'sequence_no' => $request->sequence_no]);

        return redirect(route('video.list'))->with('success', 'Video has been created');
    }
    public function edit(Request $request,$id){
        $videoedit =Video::find($id);
        $chapters =Chapter::get();
        return view('siteadmin.videoedit',['chapters'=>$chapters,'videoedit'=>$videoedit]);
    }
    public function update(Request $request, $id){

        $request->validate([
            'image'=>'image',
            'video_url'=>'mimes:mp4,mov,ogg,qt,flv,m3u8,ts,3gp,avi,wmv'
        ]);

        $category=Video::findOrFail($id);

        if(isset($request->image)){
            $file=$request->image;


            $name=str_replace(' ', '_', $request->image->getClientOriginalName());

            $path='videos/'.$name;

            Storage::put($path, file_get_contents($file));

        }else{
            $path=$category->getOriginal('image');
        }

        if(isset($request->video_url)){
            $file2=$request->video_url;

            $name2=str_replace(' ', '_', $request->video_url->getClientOriginalName());

            $path2='videos/'.$name2;

            Storage::put($path2, file_get_contents($file2));
        }else{
            $path2=$category->getOriginal('video_url');
        }

        $category->update(['name' => $request->name,
            'image' => $path,
            'video_url' => $path2,
            'isactive' => $request->isactive,
            'chapter_id' => $request->chapter_id,
            'description' => $request->description,
            'sequence_no' => $request->sequence_no]);

        return redirect(route('video.list'))->with('success','Video has been updated');
    }
}
