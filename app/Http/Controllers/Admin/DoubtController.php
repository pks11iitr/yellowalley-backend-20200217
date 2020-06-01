<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doubt;
use Illuminate\Http\Request;

class DoubtController extends Controller
{
    public function index(Request $request){



        if(isset($request->search)){
            $doubts=Doubt::where(function($doubts) use ($request){
                $doubts->where('name', 'like', "%".$request->search."%")
                    ->orWhere('email', 'like', "%".$request->search."%")
                    ->orWhere('mobile', 'like', "%".$request->search."%")
                    ->orWhere('subject', 'like', "%".$request->search."%")
                    ->orWhere('description', 'like', "%".$request->search."%");
            });
        }else{
            $doubts =Doubt::where('id', '>=', 1);
        }

        if(isset($request->datefrom))
            $doubts = $doubts->where('updated_at', '>=', $request->datefrom.' 00:00:00');
        if(isset($request->dateto))
            $doubts = $doubts->where('updated_at', '<=', $request->dateto.' 23:59:59');

        $doubts =$doubts->paginate(20);


        return view('siteadmin.doubtslist',['doubts'=>$doubts]);
    }
}
