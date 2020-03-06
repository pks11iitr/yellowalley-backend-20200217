<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table='user_attempts';

    protected $fillable=['refid', 'chapter_id', 'user_id'];

    public function answers(){
        return $this->hasMany('App\Models\Answer', 'test_id');
    }

    public function chapter(){
        return $this->belongsTo('App\Models\Chapter', 'chapter_id');
    }

    public function getQuestion($sequence_no){
        $question=$this->chapter->questions()->where('sequence_no', $sequence_no)->firstOrFail();
        return $question;
    }

    public function giveAnswer($sequence_no, $answer){
        $question=$this->chapter->questions()->where('questions.sequence_no', $sequence_no)->firstOrFail();
        Answer::updateOrCreate([
            'test_id'=>$this->id,
            'question_id'=>$question->id,
        ],[
            'answer'=>$answer,
            'iscorrect'=>$question->answer==$answer
        ]);
        return $question;
    }

    public function setScore(){
        $score=$this->answers()->where('iscorrect', true)->sum('iscorrect');
        Score::updateOrCreate([
            'user_id'=>auth()->user()->id,
            'chapter_id'=>$this->chapter_id
        ],[
            'score'=>$score,
        ]);

        return $score;
    }

}
