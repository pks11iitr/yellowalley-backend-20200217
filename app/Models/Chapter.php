<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use Active;

    protected $table='chapters';

    protected $hidden = [
        'created_at', 'deleted_at','updated_at'
    ];

    public function scores(){
        return $this->hasOne('App\Models\UserScore', 'chapter_id');
    }

    public function videos(){
        return $this->hasMany('App\Models\Video', 'chapter_id');
    }

    public function isLockedForUser($user){
        if($user->isSubscriptionActive()){
            if($this->sequence_no <= $user->last_qualified_chapter)
                return [
                    'status'=>'open',
                    'reason'=>''
                ];
            else
                return [
                    'status'=>'locked',
                    'reason'=>"Clear Chapter ".($this->sequence_no-1).' exam first'
                ];
        }else{
            if($this->sequence_no < 2)
                return [
                    'status'=>'open',
                    'reason'=>''
                ];
            else
                return [
                    'status'=>'locked',
                    'reason'=>'subscribe'
                ];
        }
    }

    public function questions(){
        return $this->hasMany('App\Models\Question', 'chapter_id');
    }
}
