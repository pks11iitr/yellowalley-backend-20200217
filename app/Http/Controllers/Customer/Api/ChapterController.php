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
        $chaptersarr=[];
        foreach($chapters as $c){
            $c->lock_status=$c->isLockedForUser($user);
            $chapterarr[]=$c;
        }
        return [
            'status'=>'success',
            'data'=>compact('chapterarr')
        ];

    }
}
