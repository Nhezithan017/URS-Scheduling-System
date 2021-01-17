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
}
