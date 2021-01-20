<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
}
