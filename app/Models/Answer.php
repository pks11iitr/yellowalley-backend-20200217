<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table='user_answers';

    protected $fillable=['question_id','answer','iscorrect', 'test_id'];

}
