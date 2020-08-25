<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\Video;
use App\User;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        //var_dump(auth()->user());die;
        $users =User::count()-1;
        $chapters =Chapter::active()->count();
        $videos =Video::active()->count();
        $questions=Question::active()->count();
        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
        $this_week_sd = date("Y-m-d",$monday);
        $this_week_ed = date("Y-m-d",$sunday);

        $usersnew=User::where('id','>', 1)->where('created_at', '>=', $this_week_sd.' 00:00:00')->where('created_at', '<=', $this_week_ed.' 23:59:59')->count();

        $paidusers = User::where('subscription_payment_status', 'paid')
            ->where('subscription_expiry', '>=', date('Y-m-d'))
        ->where('users.id','>', 1)->count();

        $chapterscount=Chapter::active()->count();

        $userscores=User::join('user_scores', 'users.id','=', 'user_scores.user_id')
            ->select(DB::raw("COUNT(*) count, users.id"))
            ->groupBy("users.id")
            ->having('count', '=', $chapterscount-1)
            ->get();
        $completeuser=count($userscores);

        return view('siteadmin.dashboard',compact('users','videos','chapters','usersnew', 'paidusers', 'completeuser','questions'));
    }





}
