<?php

use App\AllocateClassroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class AllocateClassRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    

        AllocateClassroom::create([
            [
                'room_no' => 'AB-1',
                'teacher' => 'Joriz Chiong',
                'days' => "['M','W','F']",
                'start_time' => Carbon::now()->format('H:i'),
                'start_end' => Carbon::now()->format('H:i'),
                'subject_id' => 1,
                'section_id' => 1
           ],
           [
            'room_no' => 'AC-1',
            'teacher' => 'Manuel Dangan',
            'days' => "['M','W','F']",
            'start_time' => Carbon::now()->format('H:i:s'),
            'start_end' => Carbon::now()->format('H:i:s'),
            'subject_id' => 1,
            'section_id' => 1
            ]
        ]);

       
    }
}
