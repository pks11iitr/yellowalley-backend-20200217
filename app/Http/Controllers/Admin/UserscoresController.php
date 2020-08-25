<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\User;
use Illuminate\Http\Request;

class UserscoresController extends Controller
{
    public function index(Request $request){
        if(isset($request->user)){
            $userscores =Score::with('user')->whereHas('user', function($user) use ($request){
                $user->where('name', 'like', "%".$request->user."%");
            })->orderBy('user_scores.updated_at', 'desc')->paginate(20);
        }else{
            $userscores =Score::orderBy('user_scores.updated_at', 'desc')->paginate(20);
        }

        $users=User::select('id', 'name')->get();
        return view('siteadmin.userscore',['userscores'=>$userscores, 'users'=>$users]);
    }
}
