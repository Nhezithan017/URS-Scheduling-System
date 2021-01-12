<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function subjectAssignTo()
    {
        return $this->hasOne('App\SubjectAssignTo');
    }
    public function subjects()
    {
        return $this->hasMany('App\Subject','id','course_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');

    }
}
