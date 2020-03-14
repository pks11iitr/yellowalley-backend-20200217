<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\OTPModel;
use App\Services\SMS\Msg91;
use App\User;
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

    public function updateProfile(Request $request){
        $request->validate([
            'address'=>'required|string|max:150',
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:60',
            'gender'=>'required|in:male,female',
            'city'=>'required|string|max:50',
            'pincode'=>'required|string|max:10',
            'qualification'=>'required|string|max:50',
            'dob'=>'required|date_format:Y-m-d'
        ]);
        $user=auth()->user();
        if($user){
            $user->update(
                array_merge($request->only('name','email','address','city','gender','pincode','qualification','dob'))
            );

            return [
                'status'=>'success',
                'message'=>'Please verify otp to continue'
            ];
        }

        return [
            'status'=>'failed',
            'message'=>'Invalid request'
        ];
    }

    public function view(Request $request){
        return [
            'status'=>'success',
            'user'=>auth()->user()->only(['name','email','address','city','gender','pincode','qualification','dob','mobile'])
        ];

    }


}
