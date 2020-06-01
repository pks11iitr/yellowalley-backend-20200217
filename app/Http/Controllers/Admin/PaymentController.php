<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request){
        if(isset($request->status) && !empty($request->status))
            $payments =Payment::where('status',$request->status);
        else
            $payments =Payment::where('status', 'paid');
        if(isset($request->datefrom))
            $payments = $payments->where('updated_at', '>=', $request->datefrom.' 00:00:00');
        if(isset($request->dateto))
            $payments = $payments->where('updated_at', '<=', $request->dateto.' 23:59:59');

        if(isset($request->search)){
            $payments=$payments->where(function($payments) use ($request){
               $payments->whereHas('user', function($user) use($request){
                   $user->where('name', 'like', "%".$request->search."%");
               })->orWhere('refid', $request->search)->orWhere('razorpay_order_id', $request->search);
            });
        }

        $total=$payments->sum('amount');
        $payments=$payments->paginate(20);
        return view('siteadmin.payment',['payments'=>$payments, 'total'=>$total]);
    }
}
