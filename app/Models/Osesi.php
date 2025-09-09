<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Osesi extends Model
{
   protected $fillable = [
        'oujian_id',
        'urutan',
        'otemplate_id',
    ];

   public function oujian(){
        return $this->belongsTo(Oujian::class);
    }

    public function otemplate()
    {
        return $this->belongsTo(Otemplate::class, 'otemplate_id');
    }
}
