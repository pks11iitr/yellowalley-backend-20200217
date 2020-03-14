<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doubt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoubtController extends Controller
{
    public function index(Request $request){
        $doubts =Doubt::get();
        return view('siteadmin.doubtslist',['doubts'=>$doubts]);
    }
}
