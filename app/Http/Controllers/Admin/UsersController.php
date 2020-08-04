<?php

namespace App\Http\Controllers\admin;
use App\Exports\ReferralExport;
use App\Exports\UserExports;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Payment;
use App\User;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index(Request $request){

        if($request->export==true){
            return $this->exportUser($request);
        }


        $users = User::with('payments');

        if($request->completed==1){
            $chapterscount=Chapter::active()->count();
            $userscores=User::join('user_scores', 'users.id','=', 'user_scores.user_id')
                ->select(DB::raw("COUNT(*) count, users.id"))
                ->groupBy("users.id")
                ->having('count', '=', $chapterscount-1)
                ->get();
            $uids=[];
            foreach($userscores as $u){
                $uids[]=$u->id;
            }
            if($uids)
                $users = $users ->whereIn('id', $uids);
        }

        if(isset($request->rcode)){
            $users=$users->where('referred_by', $request->rcode);
        }

        if(isset($request->user)){
            $users=$users->where(function($users) use ($request){
                $users=$users->where('name', 'like', "%".$request->user."%")->orWhere('email', 'like', "%".$request->user."%")->orWhere('mobile', 'like', "%".$request->user."%");
            });
        }

        if(isset($request->payment_status)){
            $users=$users->whereHas('payments', function($payments) use($request){
                $payments->where('payments.status', $request->payment_status);
            });
        }

        if(isset($request->status)){
            $users=$users->where('users.status', $request->status);
        }

        if(isset($request->datefrom))
            $users=$users->where('users.created_at', '>=',$request->datefrom.' 00:00:00');

        if(isset($request->dateto))
            $users=$users->where('users.created_at', '<=', $request->datefrom.' 23:59:59');



        $users=$users->where('users.id','!=',1)->paginate(20);
        return view('siteadmin.users',['users'=>$users]);
    }

    public function exportUser(Request $request){
        $users = User::with('payments');

        if($request->completed==1){
            $chapterscount=Chapter::active()->count();
            $userscores=User::join('user_scores', 'users.id','=', 'user_scores.user_id')
                ->select(DB::raw("COUNT(*) count, users.id"))
                ->groupBy("users.id")
                ->having('count', '=', $chapterscount-1)
                ->get();
            $uids=[];
            foreach($userscores as $u){
                $uids[]=$u->id;
            }
            if($uids)
                $users = $users ->whereIn('id', $uids);
        }

        if(isset($request->rcode)){
            $users=$users->where('referred_by', $request->rcode);
        }

        if(isset($request->user)){
            $users=$users->where(function($users) use ($request){
                $users=$users->where('name', 'like', "%".$request->user."%")->orWhere('email', 'like', "%".$request->user."%")->orWhere('mobile', 'like', "%".$request->user."%");
            });
        }

        if(isset($request->payment_status)){
            $users=$users->whereHas('payments', function($payments) use($request){
                $payments->where('payments.status', $request->payment_status);
            });
        }

        if(isset($request->status)){
            $users=$users->where('users.status', $request->status);
        }

        if(isset($request->datefrom))
            $users=$users->where('users.created_at', '>=',$request->datefrom.' 00:00:00');

        if(isset($request->dateto))
            $users=$users->where('users.created_at', '<=', $request->datefrom.' 23:59:59');

        $users=$users->where('users.id','!=',1)->get();
        return Excel::download(new UserExports($users), 'users-export.xlsx');
        //return view('siteadmin.export',['users'=>$users]);
    }

    public function create(Request $request){
        return view('siteadmin.usersadd');
    }
    public function store(Request $request){

        $request->validate([
           'mobile'=>'required|unique:users'
        ]);

        if($request->subscription_expiry>0){
            $expdate = date('Y-m-d', strtotime('+'. $request->subscription_expiry .'month', strtotime("now")));
        }else{
            $expdate = null;
        }

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
        $user=User::create(array_merge($request->only(['name','gender','email','mobile','address','status','dob', 'pincode','city','qualification', 'referred_by','subscription_required','signup_complete']),['subscription_expiry'=>$expdate, 'signup_complete'=>true]));
        $user->assignRole(2);
        if($request->is_paid==1){

            $payment=Payment::where('user_id', $user->id)->where('status', 'paid')->first();
            if(!$payment){
                $rid=date('YmdHis');
                Payment::create(['user_id'=>$user->id, 'refid'=>$rid, 'amount'=>2999, 'status'=>'paid', 'razorpay_order_id'=>'offline_'.$rid]);
            }
        }

        return redirect(route('users.list'))->with('success','users has been created');
    }
    public function edit(Request $request,$id){
        $useredit =User::find($id);
        $payment=Payment::where('user_id', $useredit->id)->where('status', 'paid')->first();
        if($payment){
            $is_paid=1;
        }else{
            $is_paid=0;
        }
        return view('siteadmin.usersedit',['useredit'=>$useredit,'is_paid'=>$is_paid]);
    }
    public function update(Request $request,$id){
        if($request->subscription_expiry>0){
            $expdate = date('Y-m-d', strtotime('+'. $request->subscription_expiry .'month', strtotime("now")));
        }else{
            $expdate = null;
        }
        $useredit =User::find($id);
        $useredit->update(array_merge($request->only(['name','gender','email','address','status','dob',
            'pincode','city','qualification', 'referred_by','subscription_required',
            'signup_complete']),['subscription_expiry'=>$expdate]));



        if($request->is_paid==1){

            $payment=Payment::where('user_id', $useredit->id)->where('status', 'paid')->first();
            if(!$payment){
                $rid=date('Y-m-d H:i:s');
                Payment::create(['user_id'=>$useredit->id, 'refid'=>$rid, 'amount'=>2999, 'status'=>'paid', 'razorpay_order_id'=>'offline_'.$rid]);
            }
        }

        return redirect(route('users.list'))->with('success','users has been updated');
    }

    public function referral(Request $request){
        libxml_use_internal_errors(true);
        if(isset($request->user)){
            $referrals=User::where('id','!=',1)->where('name', 'like', "%".$request->user."%");
        }else{
            $referrals =User::where('id','!=',1);
        }

        if(isset($request->datefrom))
            $referrals = $referrals->where('updated_at', '>=', $request->datefrom.' 00:00:00');
        if(isset($request->dateto))
            $referrals = $referrals->where('updated_at', '<=', $request->dateto.' 23:59:59');



        if($request->export){
            $referrals=$referrals->get();
            return Excel::download(new ReferralExport($referrals), 'referrals-export.xlsx');
        }else{
            $referrals=$referrals->paginate(20);
            return view('siteadmin.referral',['referrals'=>$referrals]);
        }


    }

    public function delete(Request $request, $id){
        User::where('id', $id)->where('id','!=',1)->delete();
        return redirect()->back()->with('success', 'User has been deleted');
    }


}
