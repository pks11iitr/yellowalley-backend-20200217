<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
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
        return $chapter;
    }
}
