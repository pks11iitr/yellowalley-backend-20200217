<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Products;
use App\Models\Score;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request){
        $user=auth()->user();
        $banners=Banner::active()->get();
        $userscore=$user?$user->totalScore():0;
        $totalscore=Score::totalscore();
        if($user && $user->isSubscriptionActive()){
            $lastvideo=$user->lastPlayedVideo;
            if($lastvideo){
                $chapter=$lastvideo->chapter_id;
                $videos=Chapter::with(['videos'=>function($videos){
                    $videos->orderBy('videos.sequence_no','asc');
                }])->find($chapter);
            }else{
                $chapter=1;
                $videos=Chapter::with(['videos'=>function($videos){
                    $videos->orderBy('videos.sequence_no','asc');
                }])->where('sequence_no', $chapter)->first();
                $lastvideo=$videos->videos[0]??'';
            }
        }else{
            $chapter=1;
            $videos=Chapter::with(['videos'=>function($videos){
                $videos->orderBy('videos.sequence_no','asc');
            }])->where('sequence_no', $chapter)->first();
            $lastvideo=$videos->videos[0]??'';
        }

        return view('website.home', compact('banners','lastvideo', 'videos','userscore','totalscore'));
    }

}
