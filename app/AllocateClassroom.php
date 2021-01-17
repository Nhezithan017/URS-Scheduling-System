<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AllocateClassroom extends Model
{
    protected $casts = [
        'days' => 'array'
    ];
    
    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo('App\Section','section_id', 'id');
    }
    public function subject()
    {
    return $this->hasMany('App\Subject','id','subject_id');
    }
}
