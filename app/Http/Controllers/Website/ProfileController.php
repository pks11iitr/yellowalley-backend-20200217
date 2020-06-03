<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view(Request $request){
        $user=auth()->user();
       return view('website.profile', compact('user'));
    }


    public function update(Request $request){
        $request->validate([
            'address'=>'required|string|max:150',
            'gender'=>'required|in:male,female,others',
            'city'=>'required|string|max:50',
            'pincode'=>'required|string|max:10',
            'qualification'=>'required|string|max:50',
            'dob'=>'required|date_format:Y-m-d'
        ]);
        $user=auth()->user();
        if($user){
            $user->update(
                array_merge($request->only('address','city','gender','pincode','qualification','dob'))
            );

            return redirect()->back()->with('success', 'Profile has been updated');
        }

        return redirect()->back()->with('error', 'Operation is not permitted');
    }
}
