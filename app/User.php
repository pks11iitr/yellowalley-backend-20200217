<?php

namespace App;

use App\Models\Configuration;
use App\Models\Video;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Kodeine\Acl\Traits\HasRole;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile','status','gender','dob','address',
        'pincode','city','qualification', 'referral_code', 'referred_by','signup_complete','subscription_expiry','subscription_required'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function generateReferralCode(){
        $chars=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $flag=true;
            while($flag){
                $referral_code=$chars[rand(0,25)].$chars[rand(0,25)].$chars[rand(0,25)].$chars[rand(0,25)].$chars[rand(0,25)].$chars[rand(0,25)].$chars[rand(0,25)];
                if(!User::where('referral_code', $referral_code)->first())
                    return $referral_code;
            }
    }

    public function isSubscriptionActive(){
        if(!$this->subscription_required)
            return '1';
        $currentdate=date('Y-m-d H:i:s');
        if(!empty($this->subscription_expiry) && $currentdate<=$this->subscription_expiry)
            return '1';
        return '0';
    }

    public function activateSubscription($reset=true){
        $validity=Configuration::where('param_name', 'plan_validity')->first();
        $months=(int)$validity->param_value;
        $expiry=date('Y-m-d H:i:s', strtotime("+$months months"));
        $this->subscription_expiry=$expiry;

        //reset user state
        if($reset){
            $this->last_qualified_chapter=2;
            $this->last_played_video=null;
        }

        $this->save();
    }

    public function lastPlayedVideo(){
        return $this->belongsTo('App\Models\Video', 'last_played_video');
    }

    public function scores(){
        return $this->hasMany('App\Models\Score', 'user_id');
    }

    public function totalScore(){
        return $this->scores()->sum('score');
    }

    public function updateLastPlayedVideo($id){
        $video=Video::with('chapter')->findOrFail($id);
        if($this->isSubscriptionActive()){
            if(in_array($video->chapter->sequence_no, [1,2]) || $video->chapter->sequence_no <= $this->last_qualified_chapter){
                $this->last_played_video=$id;
                $this->save();
                return true;
            }
        }
        //subscription is not active
        if($video->chapter->sequence_no == 1){
            $this->last_played_video=$id;
            $this->save();
            return true;
        }
        return false;
    }

    public function referrals(){
        return User::where('referred_by',$this->referral_code)->count();
    }

    public function tests(){
        return $this->hasMany('App\Models\Test', 'user_id');
    }

    public function qualifyForNextChapter($next_chapter_sequence){
        $this->last_qualified_chapter=$next_chapter_sequence;
        $this->save();
    }

}
