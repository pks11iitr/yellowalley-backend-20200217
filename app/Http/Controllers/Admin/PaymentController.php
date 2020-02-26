<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index(Request $request){
        $payments =Payment::where('status','=','pending')->get();
        return view('siteadmin.payment',['payments'=>$payments]);
    }
}
