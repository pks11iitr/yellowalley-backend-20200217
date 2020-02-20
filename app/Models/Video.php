<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $table='videos';

    protected $hidden = [
        'created_at', 'deleted_at','updated_at'
    ];

    public function getImageAttribute($value){
        return Storage::url($value);
    }

    public function getVideoUrlAttribute($value){
        return Storage::url($value);
    }

    public function chapter(){
        return $this->belongsTo('App\Models\Chapter', 'chapter_id');
    }

}
