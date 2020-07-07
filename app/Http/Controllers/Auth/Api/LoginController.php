<?php

namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Controller;
use App\Models\OTPModel;
use App\Services\SMS\Nimbusit;
use App\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Auth $auth, JWTAuth $jwt)
    {
        $this->auth=$auth;
        $this->jwt=$jwt;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'integer', 'digits:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['mobile']),
            //'referral_code'=>User::generateReferralCode()
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
                return [
                    'status'=>'success',
                    'signupdone'=>'no',
                    'message'=>'Please complete your profile',
                    'code'=>$user->referral_code
                ];
            }
        }else if(!in_array($user->status, [0 , 1])){
            //send OTP
            return response()->json([
                'status'=>'failed',
                'message'=>'invalid login attempt',
                'errors'=>[

                ]],200);
        }else{
            if(empty(array_intersect($user->getRoles(), config('allowedusers.apiusers')))){
                return response()->json([
                    'status'=>'failed',
                    'message'=>'invalid login attempt',
                    'errors'=>[

                    ],
                ], 200);
            }
            if($user->signup_complete){
                if($otp=OTPModel::createOTP($user->id, 'login')){
                    $msg=config('sms-templates.login-otp');
                    $msg=str_replace('{{otp}}', $otp, $msg);
                    if(Nimbusit::send($request->mobile, $msg)){

                    }
                }
            }

            return [
                'status'=>'success',
                'signupdone'=>$user->signup_complete==true?'yes':'no',
                'message'=>$user->signup_complete==true?'Please verify OTP to continue':"Please complete your profile",
                'code'=>$user->referral_code
            ];
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
                'message'=>'Invalid Login Attempt',
                'errors'=>[
                ],
            ], 200);
        }else if(!($user->status==0 || $user->status==1)){
            return response()->json([
                'status'=>'failed',
                'message'=>'Account Is Not Active',
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

    public function resendOTP(Request $request){
        $this->validate($request, [
            'mobile' => ['required', 'integer', 'digits:10'],
        ]);

        $user=$this->ifUserExists($request->mobile);
        if(!$user){
            return response()->json([
                'status'=>'failed',
                'message'=>'Invalid Login Attempt',
                'errors'=>[
                ],
            ], 200);
        }else if(!in_array($user->status, [0 , 1])){
            //send OTP
            return response()->json([
                'status'=>'failed',
                'message'=>'invalid login attempt',
                'errors'=>[

                ]],200);
        }else{

            if($otp=OTPModel::createOTP($user->id, 'login')){
                $msg=config('sms-templates.login-otp');
                $msg=str_replace('{{otp}}', $otp, $msg);
                if(Nimbusit::send($request->mobile, $msg)){

                }
            }

            return [
                'status'=>'success',
                'signupdone'=>$user->signup_complete==true?'yes':'no',
                'message'=>'Please verify OTP to continue',
                'code'=>$user->referral_code
            ];
        }
    }

    public function completeProfile(Request $request){
        $request->validate([
            'code'=>'required|string|max:10',
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
                if(Nimbusit::send($user->mobile, $msg)){

                }
            }

            return [
                'status'=>'success',
                'message'=>'Please verify OTP to continue'
            ];
        }

        return [
            'status'=>'failed',
            'message'=>'Invalid Request'
        ];
    }

}
