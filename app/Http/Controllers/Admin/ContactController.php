<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(Request $request){
        if(isset($request->search)){
            $contacts=Contact::where(function($contacts) use ($request){
                $contacts->where('name', 'like', "%".$request->search."%")
                    ->orWhere('email', 'like', "%".$request->search."%")
                    ->orWhere('mobile', 'like', "%".$request->search."%")
                    ->orWhere('message', 'like', "%".$request->search."%");
            });
        }else{
            $contacts =Contact::where('id', '>=', 1);
        }

        if(isset($request->datefrom))
            $contacts = $contacts->where('updated_at', '>=', $request->datefrom.' 00:00:00');
        if(isset($request->dateto))
            $contacts = $contacts->where('updated_at', '<=', $request->dateto.' 23:59:59');

        $contacts =$contacts->orderBy('id', 'desc')->paginate(20);

        return view('siteadmin.contact', ['contacts' => $contacts]);
    }

    public function delete(Request $request,$id){
         Contact::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Contact has been deleted');
    }
}
