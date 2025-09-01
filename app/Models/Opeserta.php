<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opeserta extends Model
{
    protected $fillable = [
        'oujian_id',
        'name',
        'npm',
        'station',
        'sesi',
        'qrpeserta',
        'status',
    ];
    protected $casts = ['status' => 'boolean']; 

    public function oujian(){
        return $this->belongsTo(Oujian::class);
    }
}
