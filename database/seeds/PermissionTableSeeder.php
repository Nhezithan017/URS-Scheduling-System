<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            
            'role-list',
 
            'role-create',
 
            'role-edit',
 
            'role-delete',
 
            'user-list',
 
            'user-create',
 
            'user-edit',
 
            'user-delete',

            'course-list',
 
            'course-create',
 
            'course-edit',
 
            'course-delete',

            'section-list',
 
            'section-create',
 
            'section-edit',
 
            'section-delete',

            'allocate_classroom-list',
 
            'allocate_classroom-create',
 
            'allocate_classroom-edit',
 
            'allocate_classroom-delete',

            'subject-list',
 
            'subject-create',
 
            'subject-edit',
 
            'subject-delete',

            'instructor-list',
 
            'instructor-create',
 
            'instructor-edit',
 
            'instructor-delete',

            'audit-list',

         ];
 
 
         foreach ($permissions as $permission) {
 
              Permission::insert(['name' => $permission,
                                'guard_name' => 'web']);
 
         }

         DB::table('role_has_permissions')->insert([
                //role permission
                [
                    'permission_id' => 1,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 2,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 3,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 4,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 5,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 6,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 7,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 8,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 9,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 10,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 11,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 12,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 13,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 14,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 15,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 16,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 17,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 18,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 19,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 20,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 21,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 22,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 23,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 24,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 25,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 26,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 27,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 28,
                    'role_id'=> 1
                ],
                [
                    'permission_id' => 29,
                    'role_id'=> 1
                ],
         ]);

    }
}
