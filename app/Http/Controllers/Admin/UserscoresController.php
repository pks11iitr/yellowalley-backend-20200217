<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class UserscoresController extends Controller
{
    public function index(Request $request){
        $userscores =Score::paginate(20);
        return view('siteadmin.userscore',['userscores'=>$userscores]);
    }
}
