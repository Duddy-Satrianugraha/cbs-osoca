<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $guarded = [];

    public function rotations(){
        return $this->belongsTo(Rotation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
