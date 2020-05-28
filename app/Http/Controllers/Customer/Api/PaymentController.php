<?php

namespace App\Http\Controllers\Customer\Api;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Payment;
use App\Services\Payment\RazorPayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(RazorPayService $payment)
    {
        $this->payment=$payment;
    }

    public function subscribe(Request $request){
        $user=auth()->user();

        $payment=Configuration::where('param_name','plan_charges')->first();
        $payment_amount=(int)$payment->param_value;

        Payment::where('user_id',$user->id)->where('status','pending')->delete();

        $refid=date('YmdHis');
        $response=$this->payment->generateorderid([
            "amount"=>$payment_amount*100,
            "currency"=>"INR",
            "receipt"=>$refid,
        ]);
        $responsearr=json_decode($response);
        if(isset($responsearr->id)){
            $payment=Payment::create([
                'refid'=>$refid,
                'user_id'=>$user->id,
                'amount'=>$payment_amount,
                'razorpay_order_id'=>$responsearr->id,
                'order_id_response'=>$response
            ]);
            return response()->json([
                'status'=>'success',
                'message'=>'success',
                'data'=>[
                    'orderid'=> $payment->razorpay_order_id,
                    'total'=>$payment_amount*100,
                    'id'=>$payment->id
                ],
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Payment cannot be initiated',
                'data'=>[
                ],
            ], 200);
        }
    }

    public function verifyPayment(Request $request){
        $user=auth()->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'unauthenticated'
            ];
        $order=Payment::where('razorpay_order_id', $request->razorpay_order_id)->firstOrFail();
        $paymentresult=$this->payment->verifypayment($request->all());
        if($paymentresult){
            $order->payment_id=$request->razorpay_payment_id;
            $order->payment_id_response=$request->razorpay_signature;
            $order->status='paid';
            $order->save();

            $user->activateSubscription();

            return response()->json([
                'status'=>'success',
                'refid'=>$order->refid,
                'message'=>'Your access to full course is active now',
                'errors'=>[

                ],
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'refid'=>'',
                'message'=>'Payment is not successfull',
                'errors'=>[

                ],
            ], 200);
        }
    }


    public function paymentInfo(Request $request){
        $payment=Configuration::where('param_name','plan_charges')->first();
        $amount=(int)$payment->param_value;
        $validity=Configuration::where('param_name', 'plan_validity')->first();
        $months=(int)$validity->param_value;
        $message="Pay now to access the full course";
        return [
            'status'=>'success',
            'data'=>compact('message','amount')
        ];
    }
}
