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
                'name' => 'Joemer G. Mendoza',
                'degree' => 'Electronics Engineering ',
                'educ_status' => 'Graduated',
                'position_title' => '',
                'nature_of_appoint' => '',
             

           ],
           [
                'name' => 'John Troy C. Borromeo',
                'degree' => 'Civil Engineering',
                'educ_status' => 'Graduated',
                'position_title' => '',
                'nature_of_appoint' => '',
           ],
           [
                'name' => 'Leilane S.D. Carigma',
                'degree' => 'Computer Engineering ',
                'educ_status' => 'Graduated',
                'position_title' => '',
                'nature_of_appoint' => '',
           ],
           [
                'name' => 'Ver Ian J. Victorio',
                'degree' => 'Mechanical Engineering',
                'educ_status' => 'Graduated',
                'position_title' => '',
                'nature_of_appoint' => '',
           ],
           [
                'name' => 'John Neil B. Herrera',
                'degree' => 'Electrical Engineering ',
                'educ_status' => 'Graduated',
                'position_title' => '',
                'nature_of_appoint' => '',
           ]
           ]);
    }
}
