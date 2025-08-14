<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $guarded = [];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function stations()
    {
        return $this->hasMany(Station::class, 'sesi_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function rotasi(){
        return $this->hasMany(Rotation::class);
    }


}
