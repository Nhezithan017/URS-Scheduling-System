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
                'adviser' => 'Joemer G. Mendoza',
                'description' => 'CE',
                'course_id' => 1
           ],
           [
                'adviser' => 'John Troy C. Borromeo',
                'description' => 'CE-A',
                'course_id' => 1
            
            ]
           ]);
    }
}
