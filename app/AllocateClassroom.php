<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class AllocateClassroom extends Model
{
    use LogsActivity;
    
    protected $casts = [
        'days' => 'array',
        'section' => 'array'
    ];
    
   
    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo('App\Section','section_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo('App\Section','course_id', 'id');
    }
    public function subject()
    {
    return $this->hasMany('App\Subject','id','subject_id');
    }
  
    public function daysAndTimeOverlaps($start_time, $end_time , $days, $room_no, $section)
    {
       return  $this
                ->where(function($query) use($start_time, $end_time){
                    return $query->where('start_time', '<=', $start_time)
                                ->where('end_time', '>=', $end_time)->count() == 0;
                })
                ->where(function($query) use ($section){
                    return $query->where('course_id', '=', $section->course_id)->count() > 0;
            })
                ->where(function($query) use ($room_no){
                        return $query->where('room_no', '=', $room_no)->count() > 0;
                })
                ->whereJsonContains('days', $days)->count() > 0;
        
    }

    protected static $logAttributes = ['room_no', 'teacher_id', 'days', 'start_time', 'end_time', 'subject_id', 'section_id'];

    protected static $logName = 'Allocate of Classroom';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} the allocation of classroom.";
    }
}
