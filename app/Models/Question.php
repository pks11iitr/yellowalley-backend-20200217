<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Active;
    protected $table='questions';

    protected $fillable=['question','option1','option2','option3','option4',
        'isactive','answer','chapter_id','sequence_no'];

    protected $hidden = [
        'created_at', 'deleted_at','updated_at','answer'
    ];

    public function chapter(){
        return $this->belongsTo('App\Models\Chapter','chapter_id');
    }

}
