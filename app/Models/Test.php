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

    public function setScore($user){
        $score=$this->answers()->where('iscorrect', true)->sum('iscorrect');
        $count=Question::active()->where('chapter_id', $this->chapter_id)->count();

        if((int)$count/2 < $score){
            Score::updateOrCreate([
                'user_id'=>$user->id,
                'chapter_id'=>$this->chapter_id
            ],[
                'score'=>$score,
            ]);
            return [
                'isqualify'=>'yes',
                'score'=>$score,
                'total'=>$count
            ];
        }else{
            return [
                'isqualify'=>'no',
                'score'=>$score,
                'total'=>$count
            ];
        }
    }

    public static function isAllTestComplete($user){
        $chapters=Chapter::active()->where('hasTest', true)->where('sequence_no','>', 1)->select('id')->get();
        $chapter_ids=[];
        foreach($chapters as $c){
            $chapter_ids[]=$c->id;
        }
        //var_dump($user->scores->toArray());die;
        $tests=$user->scores()->select('user_scores.chapter_id')->get();
        //var_dump($tests->toArray());die;
        $test_chapters=[];
        foreach($tests as $t){
            if(!in_array($t->chapter_id, $test_chapters)){
                $test_chapters[]=$t->chapter_id;
            }
        }
        //var_dump($chapter_ids);
        //var_dump($test_chapters);
        if(empty(array_diff($chapter_ids,$test_chapters)) && empty(array_diff($test_chapters,$chapter_ids))){
            return true;
        }

        return false;
    }

}
