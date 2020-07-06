<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Models\OTPModel;
use App\Services\SMS\Nimbusit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('website.auth.login');
    }

    public function showOTPForm()
    {
        //var_dump(old('mobile'));die;
        if(Session::get('mobile') || old('mobile'))
            return view('website.auth.verify');
        else
            return redirect()->route('login');
    }

    public function showProfileForm()
    {
        return view('website.auth.login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'integer', 'digits:10'],
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['mobile']),
            //'referral_code'=>User::generateReferralCode()
        ]);
    }


    public function login(Request $request){
        //var_dump($request->all());die;
        $this->validator($request->toArray())->validate();
        $user=$this->ifUserExists($request->mobile);
        if(!$user){
            if($user = $this->create($request->all())){
                //event(new Registered($user));
                //sendotp
                $user->assignRole('student');
                return redirect()->route('website.complete.profile',['code'=>$user->referral_code])->with('success', 'Please complete your profile');
            }
        }else if(!in_array($user->status, [0 , 1])){
            //send OTP
            return redirect()->back()->with('error', 'This account has been blocked');
        }else{
            if($user->signup_complete){
                if($otp=OTPModel::createOTP($user->id, 'login')){
                    $msg=config('sms-templates.login-otp');
                    $msg=str_replace('{{otp}}', $otp, $msg);
                    if(Nimbusit::send($request->mobile, $msg)){

                        return redirect()->route('website.verify.otp')->with('success', 'Please verify OTP to continue')->with('mobile', $user->mobile);
                    }
                }
            }else{
                return redirect()->route('website.complete.profile',['code'=>$user->referral_code])->with('success', 'Please complete your profile');
            }
        }
    }


    protected function resendOTP(Request $request){
        $request->validate([
            'mobile'=>'required|digits:10'
        ]);
        $user=$this->ifUserExists($request->mobile);
        if($user){
            if($otp=OTPModel::createOTP($user->id, 'login')){
                $msg=config('sms-templates.login-otp');
                $msg=str_replace('{{otp}}', $otp, $msg);
                if(Nimbusit::send($request->mobile, $msg)){
                    return redirect()->route('website.verify.otp')->with('success', 'OTP have been resent')->with('mobile', $user->mobile);
                }
            }
        }else{
            return redirect()->back()->with('error', 'Invalid operation');
        }



    }

    protected function ifUserExists($mobile){
        return (User::where('mobile', $mobile)->first())??false;
    }


    //verify OTP for authentication
    public function verifyOTP(Request $request){
        $this->validate($request, [
            'mobile' => ['required', 'integer', 'digits:10'],
            'otp' => ['required', 'integer'],
        ]);
        $user=User::where('mobile', $request->mobile)->first();

        if(!$user){
            return redirect()->back()->with('error', 'Invalid Request');
        }else if(!($user->status==0 || $user->status==1)){
            return redirect()->back()->with('error', 'Invalid Request');
        }

        if(!OTPModel::verifyOTP($user->id, 'login', $request->otp)){
            //die('sd');
            return redirect()->back()->with('error', 'Otp is not correct')->with('mobile', $user->mobile);
        }

        //activate user if not activated
        if($user->status==0){
            $user->signup_complete=true;
            $user->status=1;
            $user->save();
        }

        Auth::loginUsingId($user->id);

        return redirect()->route('website.home');
    }

    public function profileform(Request $request, $code){
        $user=User::where('referral_code', $request->code)->firstOrFail();
        if($user->signup_complete==0) {
            return view('website.auth.complete-profile', compact('code','user'));
        }else{
            return redirect()->back()->with('error', 'Operation is not permitted');
        }
    }

    public function completeProfile(Request $request, $code){
        $request->validate([
            'address'=>'required|string|max:150',
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:60',
            'gender'=>'required|in:male,female,others',
            'city'=>'required|string|max:50',
            'pincode'=>'required|string|max:10',
            'qualification'=>'required|string|max:50',
            'dob'=>'required|date_format:Y-m-d'
        ]);
        $user=User::where('referral_code', $code)->first();
        if($user->signup_complete==0){
            $user->update(
                array_merge($request->only('name','email','address','city','gender','pincode','qualification','dob','referred_by'))
            );

            if($otp=OTPModel::createOTP($user->id, 'login')){
                $msg=config('sms-templates.login-otp');
                $msg=str_replace('{{otp}}', $otp, $msg);
                if(Nimbusit::send($user->mobile, $msg)){
                    return redirect()->route('website.verify.otp')->with('success', 'Please verify OTP to continue')->with('mobile', $user->mobile);
                }
            }
        }
        return redirect()->back()->with('error', 'This request is not valid');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }

}
