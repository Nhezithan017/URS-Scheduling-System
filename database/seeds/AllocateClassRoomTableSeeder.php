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

        $data = [];
        $data = ['M','W','F'];
        AllocateClassroom::create([
            [
                'room_no' => 'AB-1',
                'teacher' => 'Joriz Chiong',
                'days' => $data,
                'start_time' => Carbon::now()->format('H:i:s'),
                'start_end' => Carbon::now()->format('H:i:s'),
                'subject_id' => 1,
                'section_id' => 1
           ],
           [
            'room_no' => 'AC-1',
            'teacher' => 'Manuel Dangan',
            'days' => $data,
            'start_time' => Carbon::now()->format('H:i:s'),
            'start_end' => Carbon::now()->format('H:i:s'),
            'subject_id' => 1,
            'section_id' => 1
            ]
        ]);

       
    }
}
