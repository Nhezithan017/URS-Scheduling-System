<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InstructorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'name' => 'Joriz Chiong',
                'degree' => 'MSIT',
                'educ_status' => 'Graduated',
                'position_title' => '',
                'nature_of_appoint' => '',
             

           ],
           [
                'name' => 'Manuel Dangan',
                'degree' => 'DSIT',
                'educ_status' => 'Graduated',
                'position_title' => '',
                'nature_of_appoint' => '',
            ]
           ]);
    }
}
