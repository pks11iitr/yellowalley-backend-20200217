<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SMS\Nimbusit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function settingform(Request $request){
        $settings=Setting::all();
        return view('siteadmin.settings', compact('settings'));
    }

    public function sendotp(Request $request, $id){

        Setting::where('id', '>=', 1)->update(['otp'=>null]);

        $setting=Setting::findOrFail($id);

        $rand=rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);

        $setting->otp=$rand;
        $setting->save();


        Nimbusit::send($setting->mobile, 'Your one time password at Yellow Alley is '.$rand);

        return redirect()->back()->with('success', 'OTP has ben sent to selected mobile number');

        return redirect()->back()->with('success', 'OTP have been sent on selected mobile number');
    }

    public function changepassword(Request $request){
        $user=auth()->user();
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'otp'=>'required'
        ]);
        $settings=Setting::where('otp', $request->otp)->get();
        if($settings){
            $user->password=Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Password has been updated');
        }else{
            return redirect()->back()->with('error', 'Incorrect OTP entered');
        }
    }
}
