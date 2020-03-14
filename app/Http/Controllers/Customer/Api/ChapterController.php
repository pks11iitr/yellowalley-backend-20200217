<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Chapter;
use App\Models\Doubt;
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


    public function submitDoubt(Request $request){
        $request->validate([
            'name'=>'required|string|max:150',
            'mobile'=>'required|string|digits:10',
            'subject'=>'required|max:100',
            'description'=>'required|string|max:1000',
        ]);

        if(Doubt::create(array_merge($request->only(['name','mobile','subject','description']), ['user_id'=>auth()->user()->id]))){
            return [
                'status'=>'success',
                'message'=>'Your doubt has been submitted successfully'
            ];
        }

        return [
            'status'=>'failed',
            'message'=>'invalid request'
        ];

    }

}
