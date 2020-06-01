<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table='payments';

    protected $fillable=['refid','user_id','razorpay_order_id','order_id_response', 'payment_id','payment_id_response','status','amount'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
