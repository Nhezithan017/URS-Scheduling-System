<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'code' => 'FIL1',
                'description' => 'Filipino',
                'lec' => 3,
                'lab' => 0,
                'unit' => 3
           ],
           [
                'code' => 'ENG1',
                'description' => 'English',
                'lec' => 3,
                'lab' => 0,
                'unit' => 3
            
            ]
           ]);
    }
}
