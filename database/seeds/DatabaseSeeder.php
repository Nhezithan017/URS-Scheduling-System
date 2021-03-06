<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call(CourseTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(InstructorTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        // $this->call(AllocateClassRoomTableSeeder::class);
    }
}
