<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'description' => 'Bachelor of Science in Computer Engineering',
                'sy_start' => 2020,
                'sy_end' => 2021,
                'semester' => '1st Semester',
                'user_id' => 1
           ],
           [
            
                'description' => 'Bachelor of Science in Electrical Engineering',
                'sy_start' => 2021,
                'sy_end' => 2022,
                'semester' => '1st Semester',
                'user_id' => 1
            
            ]
           ]);
    }
}
