<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request){
        $users = User::leftjoin('payments', 'users.id','=', 'payments.user_id')->select('users.*', 'payments.status');
        if(isset($request->user)){
            $users=$users->where(function($users) use ($request){
                $users=$users->where('name', 'like', "%".$request->user."%")->orWhere('email', 'like', "%".$request->user."%")->orWhere('mobile', 'like', "%".$request->user."%");
            });
        }

        $users=$users->where('users.id','!=',1)->paginate(20);
        return view('siteadmin.users',['users'=>$users]);
    }
    public function create(Request $request){
        return view('siteadmin.usersadd');
    }
    public function store(Request $request){
        $expdate = date('Y-m-d', strtotime('+'. $request->subscription_expiry .'month', strtotime("now")));
        //$mon=date('m', strtotime(-strtotime("now"), $expdate));
        //var_dump($mon); die();
        /*$expdate2=strtotime($expdate);
       // $expdate2=strtotime($useredit->subscription_expiry);
        $currentdate1 = date('Y-m-d', strtotime('-1 days', strtotime("now")));

        $currentdate=strtotime($currentdate1);

        $diff_date = abs($expdate2 - $currentdate);

        $years = floor($diff_date / (365*60*60*24));
        $months = floor(($diff_date - $years * 365*60*60*24)/ (30*60*60*24));

        var_dump($months);die();*/
        $refrelcode= User::generateReferralCode();
        User::create(array_merge($request->only(['name','gender','email','mobile','address','status','dob',
            'pincode','city','qualification', 'referred_by','subscription_required',
            'signup_complete']),['subscription_expiry'=>$expdate,'referral_code'=>$refrelcode]));
        return redirect(route('users.list'))->with('success','users has been created');
    }
    public function edit(Request $request,$id){
        $useredit =User::find($id);
        return view('siteadmin.usersedit',['useredit'=>$useredit]);
    }
    public function update(Request $request,$id){
        $expdate = date('Y-m-d', strtotime('+'. $request->subscription_expiry .'month', strtotime("now")));
        $useredit =User::find($id);
        $useredit->update(array_merge($request->only(['name','gender','email','address','status','dob',
            'pincode','city','qualification', 'referred_by','subscription_required',
            'signup_complete']),['subscription_expiry'=>$expdate]));
        return redirect(route('users.list'))->with('success','users has been updated');
    }

    public function referral(Request $request){
        $referrals =User::where('id','!=',1)->paginate(20);
        return view('siteadmin.referral',['referrals'=>$referrals]);
    }

    public function delete(Request $request, $id){
        Banner::where('id', $id)->where('id','!=',1)->delete();
        return redirect()->back()->with('success', 'User has been deleted');
    }
}
