<?php

namespace App\Http\Controllers\Customer\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function updateLastPlayed(Request $request){
        $request->validate([
           'video_id'=>'required|integer'
        ]);
        $user=auth()->user();
        if($user->updateLastPlayedVideo($request->video_id)){
            return [
                'status'=>'success',
            ];
        }
        return [
            'status'=>'failed'
        ];
    }
}
