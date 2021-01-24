<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            [
                'adviser' => 'Joriz Chiong',
                'description' => '1B',
                'course_id' => 1
           ],
           [
                'adviser' => 'Manuel Dangan',
                'description' => '1B',
                'course_id' => 1
            
            ]
           ]);
    }
}
