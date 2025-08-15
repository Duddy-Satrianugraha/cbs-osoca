<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otemplate extends Model
{
     protected $guarded = [];
     public function rubriks()
     {
         return $this->hasMany(Orubrik::class);
     }    
     
}
