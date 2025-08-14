<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $guarded = [];

    public function sesi()
    {
        return $this->hasMany(Sesi::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function rotations()
    {
        return $this->hasMany(Rotation::class);
    }

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }
}
