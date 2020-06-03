<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function about(Request $request){
        return view('website.abouts');
    }

    public function privacy(Request $request){
        return view('website.privacy');
    }

    public function tnc(Request $request){
        return view('website.term');
    }

    public function chat(Request $request){
        return view('website.chat');
    }

    public function faqs(Request $request){
        return view('website.faq');
    }

    public function contactForm(Request $request){
        return view('website.contact-us');
    }

    public function submitQuery(Request $request){
        $request->validate([
            'name'=>'required|string|max:150',
            'mobile'=>'required|string|digits:10',
            'message'=>'required|max:1000',
            'email'=>'required|max:100',
        ]);

        if(Contact::create(array_merge($request->only(['name','mobile','message','email']), ['user_id'=>auth()->user()->id??0]))){
            return redirect()->back()->with('success', 'Your message has been sent successfully');
        }
    }
}
