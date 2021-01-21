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
  
    public function daysAndTimeOverlaps($start_time, $end_time, $days, $id)
    {
        $d_t_c = DB::table('allocate_classrooms')
                        ->whereIn('days', [$days])
                        ->where('start_time','<=', $start_time)
                        ->where('end_time', '>=', $end_time)
                        ->count() == 0;
        
        if($d_t_c){
            return redirect('section/' . $id . '/show')
                ->with('success','time and days overlap');
        }
    }

    protected static $logAttributes = ['room_no', 'teacher_id', 'days', 'start_time', 'end_time', 'subject_id', 'section_id'];

    protected static $logName = 'allocate_classroom';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} the allocation of classroom.";
    }
}
