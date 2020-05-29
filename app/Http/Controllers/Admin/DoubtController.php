<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doubt;
use Illuminate\Http\Request;

class DoubtController extends Controller
{
    public function index(Request $request){
        $doubts =Doubt::paginate(20);
        return view('siteadmin.doubtslist',['doubts'=>$doubts]);
    }
}
