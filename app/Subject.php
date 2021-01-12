<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->hasOne('App\Course','id','course_id');
    }
    public function subjectAssignTo()
    {
        return $this->hasOne('App\SubjectAssignTO');
    } 
}
