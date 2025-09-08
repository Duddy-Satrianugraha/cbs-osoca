<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onilai extends Model
{
    protected $fillable = [
        'oujian_id','station_id','sesi_id','qrpeserta','nama','npm','skor','jumlah','nilai', 'peserta_id',
        ];

    public function peserta(){
        return $this->belongsTo(Opeserta::class);
    }

}
