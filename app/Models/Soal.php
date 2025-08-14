<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $guarded = [];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function sesis()
    {
        return $this->belongsTo(Sesi::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
