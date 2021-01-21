<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\DataContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use App\Subject;
use App\Teacher;
use Yajra\DataTables\DataTables;
class SectionController extends Controller
{
    public function __construct(Section $sections, DataContent $data_content, Teacher $instructors)
    {
        $this->middleware('permission:allocate_classroom-list', ['only' => ['showSections']]);
        $this->middleware('permission:section-create', ['only' => ['createSection']]);
        $this->middleware('permission:section-edit', ['only' => ['showSection','updateSection']]);
        $this->middleware('permission:section-delete', ['only' => ['deleteSection']]);

        $this->year = $data_content->year; 
        $this->sections = $sections;
        $this->section = $data_content->section;
        $this->instructors = $instructors;   
    }
    
    public function showSections(Request $request, Section $section)
    {
        if ($request->ajax()) {
            $data = $section->allocate_classroom;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('subject', function($row){
                            $subject = Subject::find($row->subject_id);
                            return $subject->description . ' (' . $subject->code . ')';
                    })
                    ->addColumn('instructor', function($row){
                            
                        $instructor = Teacher::find($row->teacher_id);
                        return $instructor->name;
                     })
                    ->addColumn('status', function($row){
                            
                                return $row->status === 1 ? 'ok' : 'not';
                            
                                    
                     })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="'. route('allocate_classroom.show', $row->id) .'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <input type="hidden" value="'. $row->id .'" id="userId"/>
                            <button type="button" name="deleteButton" id="' . $row->id . '" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
                        </div>';

                            // '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['instructor'])
                    ->rawColumns(['subject'])
                    ->rawColumns(['status'])
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.sections.show', compact('section'));
    }
    public function createSection(Request $request, Course $course)
    {
        $data = [];

        
            if($request->isMethod('post')){

                $data = $this->validate($request, [
                    'adviser' => 'required',
                    'year' => 'required',
                    'section' => 'required'
                ]);

                $course->sections()->create($data);
                
                return redirect('courses/' . $course->id . '/show')
            ->with('success','section create successfully');
            
                }
        $data['course_id'] = $course->id;

            
        
        $data['modify'] = 0;
        $data['year'] = $this->year;
        $data['section'] = $this->section;
        $data['instructors'] = $this->instructors->latest()->get();
        return view('admin.sections.form', $data);
    }
 

    public function showSection(Request $request, $id)
    {
        $data = [];
        $data['modify'] = 1;
        $data['section_id'] = $id;

        $data['sections'] = $this->sections->find($id);
        
        $data['course_id'] = $data['sections']->course_id;

        $data['year'] = $this->year;
         
        $data['section'] = $this->section;
        $data['instructors'] = $this->instructors->latest()->get();
        return view('admin.sections.form', $data);
    }

    public function updateSection(Request $request, $id, Course $course)
    {

        $data = [];

        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'adviser' => 'required',
                'year' => 'required',
                'section' => 'required'
            ]);


            
            $this->sections->find($id)->update($data);

            $course_id = $this->sections->find($id);
                
            return redirect('courses/' . $course_id->course_id . '/show')
        ->with('success','Section update successfully');
        }
    }

    public function deleteSection($id){

        $this->sections->find($id)->delete($id);
        $course_id = $this->sections->find($id);

        return redirect('courses/'. $course_id . '/show')
        ->with('success','Section deleted successfully');
    }

}
