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
  
    public function daysAndTimeOverlaps($start_time, $end_time, $days , $section_id)
    {
        $query =  DB::table('allocate_classrooms');

        $day = $query->all('days');

            
        $time = $query->where('start_time', '<=' , $start_time)
                        ->where('end_time', '>=', $end_time)
                        ->count();

        if((count(array_diff($day, $days)) > 0) && $time === 0){
            return redirect('section/' . $section_id . '/show')
                ->with('success','time and days overlap');
        }
    }

    protected static $logAttributes = ['room_no', 'teacher_id', 'days', 'start_time', 'end_time', 'subject_id', 'section_id'];

    protected static $logName = 'Allocate of Classroom';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} the allocation of classroom.";
    }
}
