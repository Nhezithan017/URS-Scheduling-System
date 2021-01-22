<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];

   public function allocate_classroom()
   {
       return $this->belongsTo('App\AllocateClassroom');
   }
}
