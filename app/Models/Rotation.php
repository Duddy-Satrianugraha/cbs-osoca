<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rotation extends Model
{
    protected $guarded = [];
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function sesi(){
        return $this->belongsTo(Sesi::class);
    }

    public function pesertas(){
        return $this->hasMany(Peserta::class);
    }
}
