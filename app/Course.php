<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    // public function subjectAssignTo()
    // {
    //     return $this->hasOne('App\SubjectAssignTo');
    // }
    public function sections()
    {
        return $this->hasMany('App\Section');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');

    }
}
