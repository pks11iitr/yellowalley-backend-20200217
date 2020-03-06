<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    public function index(Request $request){
        $user=auth()->user();
        $chapters=Chapter::active()->get();
        $chapterarr=[];
        foreach($chapters as $c){
            $c->lock_status=$c->isLockedForUser($user);
            $chapterarr[]=$c;
        }
        return [
            'status'=>'success',
            'data'=>compact('chapterarr')
        ];
    }

    public function questions(Request $request, $id){
        $user=auth()->user();
        $chapter=Chapter::active()->with('questions')->findOrFail($id);
        if($user->isSubscriptionActive()){
            if($chapter->sequence_no<=$user->last_qualified_chapter) {
                return [
                    'status'=>'success',
                    'data'=>compact('chapter')
                ];
            }
        }else{
            if(in_array($chapter->sequence_no, [1]))
                return [
                    'status'=>'success',
                    'data'=>compact('chapter')
                ];
        }
        return [
            'status'=>'failed',
            'message'=>'invalid request'
        ];
    }

    public function videos(Request $request, $id){
        $user=auth()->user();
        $chapter=Chapter::active()->with('videos')->findOrFail($id);
        if($user->isSubscriptionActive()){
            if($chapter->sequence_no<=$user->last_qualified_chapter) {
                return [
                    'status'=>'success',
                    'data'=>compact('chapter')
                ];
            }
        }else{
            if(in_array($chapter->sequence_no, [1]))
                return [
                    'status'=>'success',
                    'data'=>compact('chapter')
                ];
        }
        return [
            'status'=>'failed',
            'message'=>'invalid request'
        ];
    }

}
