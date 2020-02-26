<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table="user_scores";

    protected $fillable=['chapter_id','user_id','score'];

    protected $hidden = [
        'created_at', 'deleted_at','updated_at'
    ];

    public static function totalscore(){
        return Question::active()->count();
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function chapter(){
        return $this->belongsTo('App\Models\Chapter','chapter_id');
    }

}
