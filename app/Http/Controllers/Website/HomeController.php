<?php

namespace App\Http\Controllers\Website;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use App\Models\Banner;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home(Request $request){
        return view('website.home');
    }

}
