<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Models\OTPModel;
use App\Services\SMS\Msg91;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    use AuthenticatesUsers;

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
        return view('website.auth.verify');
    }

    public function showProfileForm()
    {
        return view('website.auth.login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|integer|digits:10',
            'password' => 'required|string',
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['mobile']),
            'referral_code'=>User::generateReferralCode()
        ]);
    }


    public function login(Request $request){
        $this->validator($request->toArray())->validate();
        $user=$this->ifUserExists($request->mobile);
        if(!$user){
            if($user = $this->create($request->all())){
                //event(new Registered($user));
                //sendotp
                $user->assignRole('student');
                return redirect()->route('website.complete.profile',['code',$user->referral_code])->with('success', 'Please complete your profile');
            }
        }else if(!in_array($user->status, [0 , 1])){
            //send OTP
            return redirect()->back()->with('error', 'This account has been blocked');
        }else{
            if($user->signup_complete){
                if($otp=OTPModel::createOTP($user->id, 'login')){
                    $msg=config('sms-templates.login-otp');
                    $msg=str_replace('{{otp}}', $otp, $msg);
                    if(Msg91::send($request->mobile, $msg)){
                        return redirect()->route('website.verify.otp')->with('success', 'Please verify OTP to continue');
                    }
                }
            }else{
                return redirect()->route('website.complete.profile',['code',$user->referral_code])->with('success', 'Please complete your profile');
            }
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
            return response()->json([
                'status'=>'failed',
                'message'=>'invalid login attempt',
                'errors'=>[
                ],
            ], 200);
        }else if(!($user->status==0 || $user->status==1)){
            return response()->json([
                'status'=>'failed',
                'message'=>'account is not active',
                'errors'=>[

                ],
            ], 200);
        }

        if(!OTPModel::verifyOTP($user->id, 'login', $request->otp)){
            return response()->json([
                'status'=>'failed',
                'message'=>'Incorrect OTP',
                'errors'=>[

                ],
            ], 200);
        }

        //activate user if not activated
        if($user->status==0){
            $user->signup_complete=true;
            $user->status=1;
            $user->save();
        }

        return [
            'status'=>'success',
            'message'=>'Login Successfull',
            'token'=>$this->jwt->fromUser($user),
            'subscription_active'=>$user->isSubscriptionActive()
        ];
    }

    public function completeProfile(Request $request){
        $request->validate([
            'code'=>'required|string|max:7',
            'address'=>'required|string|max:150',
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:60',
            'gender'=>'required|in:male,female,others',
            'city'=>'required|string|max:50',
            'pincode'=>'required|string|max:10',
            'qualification'=>'required|string|max:50',
            'dob'=>'required|date_format:Y-m-d'
        ]);

        $user=User::where('referral_code', $request->code)->first();
        if($user->signup_complete==0){
            $user->update(
                array_merge($request->only('name','email','address','city','gender','pincode','qualification','dob','referred_by'))
            );

            if($otp=OTPModel::createOTP($user->id, 'login')){
                $msg=config('sms-templates.login-otp');
                $msg=str_replace('{{otp}}', $otp, $msg);
                if(Msg91::send($request->mobile, $msg)){
                    return redirect()->route('website.verify.otp')->with('success', 'Please verify OTP to continue');
                }
            }
        }
        return redirect()->back()->with('error', 'This request is not valid');
    }
}
