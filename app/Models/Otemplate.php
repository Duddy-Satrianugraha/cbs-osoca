<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otemplate extends Model
{
     protected $guarded = [];

     public function rubrix()
     {
         return $this->hasMany(Orubrik::class, 'otemplate_id', 'id');
     }    
     
}
