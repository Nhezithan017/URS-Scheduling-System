<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataContent extends ReadOnlyBase
{
    public $days = [
        'M' => 'Monday',
        'T' => 'Tuesday',
        'W' => 'Wednesday',
        'TH' => 'Thursday',
        'F' => 'Friday',
        'S' => 'Saturday',
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
         'Irregular Student',
         'Old Curriculum',
         'Subject from other program'

     ];

     public $rooms = [
        '1-A',
        '1-B',
        '1-C',
        '2-A',
        '2-B',
        '2-C',
        '3-A',
        '3-B',
        '3-C',
     ];
   
     public $lec = [
         1, 2, 3, 4, 5
     ];
     public $lab = [
        1, 2, 3, 4, 5
    ];
    public $unit = [
        1, 2, 3, 4, 5
    ];
    public $class_size = [
     1,
     2,
     3,
     4,
     5,
     6,
     7,
     8,
     9,
     10,
     11,
     12,
     13,
     14,
     15,
     16,
     17,
     18,
     19,
     20,
     21,
     22,
     23,
     24,
     25,
     26,
     27,
     28,
     29,
     30,
     31,
     32,
     33,
     34,
     35,
     36,
     37,
     38,
     39,
     40,
     41,
     42,
     43,
     44,
     45,
     46,
     47,
     48,
     49,
     50,
     51,
     52,
     53,
     54,
     55,
     56,
     57,
     58,
     59,
     60
    ];

     }
