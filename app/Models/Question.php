<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Active;
    protected $table='questions';

    protected $hidden = [
        'created_at', 'deleted_at','updated_at','answer'
    ];

}
