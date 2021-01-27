<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyBase 
{
    protected $days = [];
    protected $semester = [];
    protected $department = [];
    protected $year = [];
    protected $section = [];
    protected $rooms = [];
    protected $lec = [];
    protected $lab = [];
    protected $unit = [];
    public $class_size = [];
    
    public function days(){
        return $this->days;
    }

    public function semester(){
        return $this->semester;
    }
    public function department(){
        return $this->department;
    }
    public function year(){
        return $this->year;
    }
    public function section(){
        return $this->section;
    }
    public function rooms(){
        return $this->rooms;
    }
    public function lec(){
        return $this->lec;
    }
    public function lab(){
        return $this->lab;
    }
    public function unit(){
        return $this->unit;
    }
    public function class_size(){
        
       $this->class_size;
    }
}
