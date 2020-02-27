<?php

namespace App\Http\Controllers\Admin;

use App\Models\Score;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request){
        //var_dump(auth()->user());die;
        $users =User::count();
        $userscore =Score::count();
        return view('siteadmin.dashboard',['users'=>$users,'userscore'=>$userscore]);
    }
}
