<?php

namespace App\Http\Controllers\Admin;

use App\AllocateClassroom;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use App\Subject;
use App\Teacher;
use App\User;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    
    public function __construct(Subject $subjects, Teacher $teachers, User $users, Activity $activities, Course $courses, Section $sections)
    {
        $this->users = $users;
        $this->teachers = $teachers;
        $this->subjects = $subjects;
        $this->activities = $activities;
        $this->courses = $courses;
        $this->sections = $sections;
    }
    public function dashboard(){

        $data = [];

        $data['users'] = $this->users->all()->count();
        $data['teachers'] = $this->teachers->all()->count();
        $data['subjects'] = $this->subjects->all()->count();
        $data['activities'] = $this->activities->all()->count();
        $data['courses'] = $this->courses->all()->count();
        $data['sections'] = $this->sections->all()->count();

        return view('admin.dashboard.index', $data);
    }
}
