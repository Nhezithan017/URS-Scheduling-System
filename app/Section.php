<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Section extends Model
{
    use LogsActivity;
    
    protected $guarded = [];
    public function course(){
        return $this->belongsTo('\App\Course', 'id', 'course_id');
    }
    public function allocate_classroom(){
        return $this->hasMany('\App\AllocateClassroom');
    }

    
    protected static $logAttributes = ['adviser', 'year', 'section'];

    protected static $logName = 'Section';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} the section.";
    }
}
