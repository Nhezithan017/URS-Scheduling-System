<?php

namespace App\Http\Controllers\Admin;

use App\DataContent;
use App\Course;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function __construct(Course $courses, DataContent $data_content)
    {
        $this->courses = $courses;
        $this->semester = $data_content->semester;
        $this->department = $data_content->department;
    }
    public function getCourses(Request $request){

        if ($request->ajax()) {
            $data = Course::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="'. route('courses.show', $row->id) .'" class="btn btn-primary"><i class="fas fa-fw fa-plus-square"></i> Section</a>
                            <a href="'. route('course.show', $row->id) .'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <input type="hidden" value="'. $row->id .'" id="userId"/>
                            <button type="button" name="deleteButton" id="' . $row->id . '" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
                        </div>';

                            // '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.courses.index');
    }
    public function showCourses(Request $request, Course $course)
    {

        if ($request->ajax()) {
            $data = $course->sections;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="'. route('sections.show', $row->id) .'" class="btn btn-primary"><i class="fas fa-fw fa-plus-square"></i> Subject</a>
                            <a href="'. route('section.show', $row->id) .'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <input type="hidden" value="'. $row->id .'" id="userId"/>
                            <button type="button" name="deleteButton" id="' . $row->id . '" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
                        </div>';

                            // '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.courses.show', compact('course'));
    }
    public function createCourse(Request $request, Course $course)
    {
        $data = [];

        
        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'description' => 'required',
                'sy_start' => 'required',
                'sy_end' => 'required',
                'semester' => 'required'
            ]);

          $course->insert($data + ['user_id' => auth()->id()]);

            return redirect('courses')
        ->with('success','Course create successfully');
        }

        $data['modify'] = 0;
        $data['semester'] = $this->semester;
        $data['department'] = $this->department;
        return view('admin.courses.form', $data);
    }

    public function showCourse($id, Request $request)
    {
        $data = [];
        $data['modify'] = 1;
        $data['course_id'] = $id;

        $data['course'] = $this->courses->find($id);
        $data['semester'] = $this->semester;
        $data['department'] = $this->department;
        
        return view('admin.courses.form', $data);
    }
    public function updateCourse(Request $request, $id, Course $course)
    {

        $data = [];

        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'description' => 'required',
                'sy_start' => 'required',
                'sy_end' => 'required',
                'semester' => 'required'
            ]);


            
            $this->courses->find($id)->update($data);

            return redirect('courses')
        ->with('success','Course Update successfully');
        }
    }

    public function deleteCourse($id){

        $this->courses->find($id)->delete($id);

        return redirect()->route('courses.index')
        ->with('success','Course deleted successfully');
    }
}

