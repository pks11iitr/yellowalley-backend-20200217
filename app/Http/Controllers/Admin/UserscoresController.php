<?php

namespace App\Http\Controllers\Admin;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserscoresController extends Controller
{
    public function index(Request $request){
        $userscores =Score::get();
        return view('siteadmin.userscore',['userscores'=>$userscores]);
    }
}
