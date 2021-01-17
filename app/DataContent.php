<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataContent extends ReadOnlyBase
{
    public $days = [
        'MON' => 'Monday',
        'TUE' => 'Tuesday',
        'WED' => 'Wednesday',
        'THUR' => 'Thursday',
        'FRI' => 'Friday',
        'SAT' => 'Saturday',
        'SUN' => 'Sunday'
     ];

     public $semester = [
        '1st Semester',
        '2nd Semester'
     ];

     public $department = [
         'BSCE' => 'Bachelor of Science in Computer Engineering',
         'BSME' => 'Bachelor of Science in Mechanical Engineering',
         'BSEE' => 'Bachelor of Science in Electrical Engineering',
         'BSECE' => 'Bachelor of Science in Electronics Engineering',
         'BSCPE' => 'Bachelor of Science in Civil Engineering'
         
     ];
     
     
     public $year = [
         1, 2, 3, 4, 5, 6
     ];

     public $section = [
         'CE',
         'CE-A',
         'CE-B',
         'CE-C',
         'ME',
         'ME-A',
         'ME-B',
         'ME-C',
         'EE',
         'EE-A',
         'EE-B',
         'EE-C',
         'ECE',
         'ECE-A',
         'ECE-B',
         'ECE-C',
         'EE-C',
         'CPE',
         'CPE-A',
         'CPE-B',
         'CPE-C',

     ];
   
     }
