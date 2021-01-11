<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jonathan Bartolome',
        	'username' => 'Admin',
            'password' => bcrypt('p@ssword'),
            'email' => 'ahproh661@gmail.com'
        ]);
    }
}
