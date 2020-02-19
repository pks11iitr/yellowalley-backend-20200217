<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $table='gallery';
    protected $fillable=['entity_type','entity_id','doc_path','uploaded_by','isactive','partneractive'];

    public function getDocPathAttribute($value){
        return Storage::url($value);
    }
}
