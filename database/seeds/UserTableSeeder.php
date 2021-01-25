<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'password' => Hash::make('p@ssword'),
            'profile_image' => '1.jpg'
        ]);

       
       $role = Role::create(['name' => 'Admin']);

   

        $permissions = Permission::pluck('id','id')->all();

  

        $role->syncPermissions($permissions);

   

        $user->assignRole([$role->id]);
    }
}
