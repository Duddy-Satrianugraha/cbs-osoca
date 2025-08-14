<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Location extends Model
{
    protected $guarded = [];

    public function sesi()
    {
        return $this->belongsTo(Sesi::class);
    }

    public function rotations()
    {
        return $this->hasMany(Rotation::class);
    }
     public function soals(){
        return $this->hasMany(Soal::class);
     }
}
