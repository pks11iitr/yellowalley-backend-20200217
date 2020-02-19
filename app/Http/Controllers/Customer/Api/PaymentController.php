<?php

namespace App\Http\Controllers\Customer\Api;

use App\Services\Payment\RazorPayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct(RazorPayService $payment)
    {
        $this->payment=$payment;
    }

    public function paynow(Request $request, $id){
        $order=Orders::with(['details'])->findOrFail($id);
        $orderdata=[];
        $total=0;
        $orderdata['order_id']=$order->order_id;
        foreach($order->details as $d){
            if($d->order_status=='pending'){
                $total=$total+$d->product->price*$d->quantity + intval($d->product->product_weight*$d->quantity)*$d->product->delivery_per_kg_price;
            }
        }
        $orderdata['total']=$total*100;
        $orderdata['id']=$order->id;
        return $orderdata;
    }

    public function verifyPayment(Request $request){
        $user=auth()->user();
        $order=Orders::where('order_id', $request->razorpay_order_id)->firstOrFail();
        $paymentresult=$this->payment->verifypayment($request->all());
        if($paymentresult){
            $order->payment_id=$request->razorpay_payment_id;
            $order->payment_id_response=$request->razorpay_signature;
            $order->ispaid=1;
            $order->save();
            $order->details()->update(['order_status'=>'paid']);
            Cart::where('userid', $user->id)->delete();
            return response()->json([
                'status'=>'success',
                'message'=>'Payment is successfull',
                'errors'=>[

                ],
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Payment is not successfull',
                'errors'=>[

                ],
            ], 200);
        }
    }
}
