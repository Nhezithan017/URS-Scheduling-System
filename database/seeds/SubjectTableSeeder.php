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
                'code' => 'MATH 2E',
                'description' => 'Calculus 1 (Differential Calculus)',
                'lec' => 3,
                'lab' => 0,
                'unit' => 3
           ],
           [
                'code' => 'ENGG CHEM',
                'description' => 'Chemistry for Engineers',
                'lec' => 3,
                'lab' => 3,
                'unit' => 4
            
            ]
           ]);
    }
}
