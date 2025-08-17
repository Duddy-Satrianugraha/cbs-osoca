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
    ];
    public function sesi(){
        return $this->hasMany(Osesi::class);
    }

    public function peserta(){
        return $this->hasMany(Opeserta::class);
    }
}
