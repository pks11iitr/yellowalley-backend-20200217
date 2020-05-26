<?php

namespace App\Http\Controllers\Website;

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
}
