<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ofeedback extends Model
{
    protected $fillable = [
        'oujian_id','station_id','peserta_id','qrpeserta','nama','npm','feedback'
    ];
    public function peserta(){
        return $this->belongsTo(Opeserta::class);
    }

    public function station()
    {
        return $this->belongsTo(Ostation::class, 'station_id');
    }

}
