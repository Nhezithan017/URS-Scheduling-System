<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       DB::table('users')->insert([
        [
            'name' => 'Jonathan Bartolome',
        	'username' => 'Admin',
            'password' => bcrypt('p@ssword'),
            'email' => 'ahproh661@gmail.com'
       ],
       [
        'name' => 'Agnes Vismonte',
        'username' => 'Dean',
        'password' => bcrypt('p@ssword'),
        'email' => 'nheziaynhie@gmail.com'
        ]
       ]);
    }
}
