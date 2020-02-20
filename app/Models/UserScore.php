<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    protected $table='user_scores';

    protected $hidden = [
        'created_at', 'deleted_at','updated_at'
    ];

}
