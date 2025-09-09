<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oujian extends Model
{
    protected $fillable = [
        'name',
        'ta',
        'tgl_ujian',
        'jml_station',
        'jml_sesi',
        'user_id',
    ];
    public function stations()
    {
        return $this->hasMany(Ostation::class, 'oujian_id');
    }

    public function sesis()
    {
        return $this->hasMany(Osesi::class, 'oujian_id');
    }

    public function peserta(){
        return $this->hasMany(Opeserta::class);
    }
}
