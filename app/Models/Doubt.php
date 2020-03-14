<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doubt extends Model
{
    protected $table='doubts';

    protected $fillable=['name','mobile','subject','description','user_id'];
}
