<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ostation extends Model
{
    protected $fillable = [
        'oujian_id',
        'urutan',
        'name',
        'qrstation',
        'nama_penguji',
    ];
}
