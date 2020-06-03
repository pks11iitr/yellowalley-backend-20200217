<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Payment;
use App\Models\ShippingAddress;
use App\Services\Payment\RazorPayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct(RazorPayService $payment)
    {
        $this->payment=$payment;
    }

    public function view(Request $request){
        $payment=Configuration::where('param_name','plan_charges')->first();
        $payment_amount=(int)$payment->param_value;
        return view('website.payment-info', compact('payment_amount'));
    }

    public function initiate(Request $request){

        $api_key=$this->payment->api_key;
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

            return view('website.checkout', compact('payment','api_key'));

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
            return redirect()->back()->with('error', 'Payment cannot be initiated');
        }
    }

    public function verify(Request $request){
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

            return redirect()->route('website.payment.info')->with('success', 'Your access to full course is active now')->with('refid', $order->refid);

//            return response()->json([
//                'status'=>'success',
//                'refid'=>'Reference Id: '.$order->refid,
//                'message'=>'Your access to full course is active now',
//                'errors'=>[
//
//                ],
//            ], 200);
        }else{
            return redirect()->route('website.course-curriculum')->with('error', 'Your payment at Yellow Alley is not successfull. If amount have been deducted, please contact support');
        }
    }
}
