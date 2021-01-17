<?php

namespace App\Rules;

use App\AllocateClassroom;
use Illuminate\Contracts\Validation\Rule;

class TimeOverlap implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        $time_laps = AllocateClassroom::where('start_time', '<=', $value)
                                ->where('end_time','>=', $value)
                                ->count() == 0;

        $days_laps = AllocateClassroom::where('days', '==', $value)->get();

        if($time_laps && $days_laps){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Allocation of rooms overlap with existing time';
    }
}
