<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chapter;
use App\Models\Score;
use App\Models\Video;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request){
        //var_dump(auth()->user());die;
        $users =User::count()-1;
        $chapters =Chapter::active()->count();
        $videos =Video::active()->count();
        return view('siteadmin.dashboard',compact('users','videos','chapters'));
    }
}
