<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Partners;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request){

        $banner=Banner::active()->get();
        return compact('banner','maincategories');
    }
}
