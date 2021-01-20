<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use LogsActivity;

    
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


    
    protected static $logAttributes = ['description', 'sy_start', 'sy_end', 'semester'];

    protected static $logName = 'course';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} the course.";
    }
}

