<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $guarded = [];

    public function Sesis()
    {
        return $this->belongsTo(Sesi::class);
    }
}
