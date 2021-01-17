<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $guarded = [];
    public function course(){
        return $this->belongsTo('\App\Course', 'id', 'course_id');
    }
    public function allocate_classroom(){
        return $this->hasMany('\App\AllocateClassroom');
    }
}
