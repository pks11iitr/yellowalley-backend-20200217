<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request){
        if(isset($request->status) && !empty($request->status))
            $payments =Payment::where('status',$request->status)->paginate(20);
        else
            $payments =Payment::where('status', 'paid')->paginate(20);
        return view('siteadmin.payment',['payments'=>$payments]);
    }
}
