<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Partners;
use App\Models\Products;
use App\Models\Question;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request){
        $user=auth()->user();
        $banners=Banner::active()->get();
        $userscore=$user->totalScore();
        $totalscore=Score::totalscore();
        if($user->isSubscriptionActive()){
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

        return [
            'status'=>'success',
            'data'=>compact('banners','lastvideo', 'videos','userscore','totalscore')
        ];
    }
}
