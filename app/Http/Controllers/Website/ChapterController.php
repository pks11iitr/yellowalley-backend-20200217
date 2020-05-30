<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Video;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(Request $request){
        $user=auth()->user();
        $chapters=Chapter::active()->get();
        $chapterarr=[];
        foreach($chapters as $c){
            $c->lock_status=$c->isLockedForUser($user);
            //var_dump($c->lock_status);
            $chapterarr[]=$c;
        }
        //die;
        return view('website.courses', compact('chapterarr'));
    }

    public function details(Request $request, $id){
        $user=auth()->user();
        $chapter=Chapter::active()->with(['videos'=>function($videos){

            $videos->orderBy('videos.sequence_no', 'asc');

        }])->findOrFail($id);

        $chapter->lock_status=$chapter->isLockedForUser($user);

        return view('website.chapter-contents', compact('chapter'));
    }

    public function videos(Request $request, $id){
        $user=auth()->user();
        $video=Video::findOrFail($id);
        $chapter=Chapter::active()->with('videos')->findOrFail($video->chapter_id);
        if($user && $user->isSubscriptionActive()){
            if($chapter->sequence_no<=$user->last_qualified_chapter) {
                return view('website.chapter-videos', compact('chapter','video'));
            }else{
                return view('website.chapter-videos', compact('chapter','video'))->with('error', 'Please complete chapter '.($chapter->sequence_no-1).' first');
            }
        }else{
            if(in_array($chapter->sequence_no, [1])){
                return view('website.chapter-videos', compact('chapter','video'));
            }
            else{
                return view('website.chapter-videos', compact('chapter','video'))->with('error', 'Please subscribe to view this chapter');
            }

        }
    }
}
