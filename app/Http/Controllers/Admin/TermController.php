<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
{
    public function abouts(Request $request){
        return view('abouts');
    }
    public function privacy(Request $request){
        return view('privacy');
    }
    public function term(Request $request){
        return view('term');
    }
    public function chat(Request $request){
        return view('chat');
    }
}
