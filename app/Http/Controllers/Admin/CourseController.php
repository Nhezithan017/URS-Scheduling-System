<?php

namespace App\Http\Controllers\Admin;

use App\DataContent;
use App\Course;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class CourseController extends Controller
{
    public function __construct(Course $courses, DataContent $data_content)
    {
        $this->middleware('permission:course-list', ['only' => ['getCourses','deleteCourse','createCourse']]);
        $this->middleware('permission:section-list', ['only' => ['showCourses']]);
        $this->middleware('permission:course-create', ['only' => ['createCourse']]);
        $this->middleware('permission:course-edit', ['only' => ['showCourse','updateCourse']]);
        $this->middleware('permission:course-delete', ['only' => ['deleteCourse']]);

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
                        return view('admin.courses.action', compact('row'))->render();
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.courses.index');
    }

    public function print($id)
    {
        $pdf = app('dompdf.wrapper');


        
        $pdf->getDomPDF()->set_option("enable_php", true);

       $course =  $this->courses->find($id);

        $pdf->loadView('admin.courses.print', compact('course'));

            
       return $pdf->stream('invoice.pdf');
    }

  
    public function showCourses(Request $request, Course $course)
    {

        if ($request->ajax()) {
            $data = $course->sections;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return view('admin.sections.action', compact('row'))->render();
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

