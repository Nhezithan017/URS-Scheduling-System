<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllocateClassroom extends Model
{
    protected $casts = [
        'days' => 'array'
    ];

    protected $guarded = [];

    public function course()
    {
        return $this->hasOne('App\Course','id','course_id');
    }
    public function subject()
    {
        return $this->hasOne('App\Subject','id','subject_id');
    }
}
