<?php


namespace App\Http\Controllers\Admin;

use App\AllocateClassroom;
use App\Course;
use App\DataContent;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\TimeOverlap;
use App\Subject;
use App\Teacher;
use Yajra\DataTables\DataTables;


class AllocateClassroomController extends Controller
{
    public function __construct(AllocateClassroom $allocate_classroom, Subject $subjects,Teacher $instructors ,DataContent $data_content)
    {
        
        $this->middleware('permission:allocate_classroom-create', ['only' => ['createAllocateClassRoom']]);
        $this->middleware('permission:allocate_classroom-edit', ['only' => ['showAllocateClassRoom','updateAllocateClassRoom']]);
        $this->middleware('permission:allocate_classroom-delete', ['only' => ['deleteAllocateClassRoom']]);

        $this->allocate_classroom = $allocate_classroom;
        $this->subjects = $subjects;
        $this->days = $data_content->days;
        $this->rooms = $data_content->rooms;
        $this->class_size = $data_content->class_size;
        $this->instructors = $instructors;

        $this->year = $data_content->year; 
        $this->section = $data_content->section;
    }
    public function createAllocateClassRoom(Request $request, Section $section)
    {
        $data = [];

       
        $course_id = $section->course_id;

            if($request->isMethod('post')){

                $data = $this->validate($request, [
                    'room_no' => 'required',
                    'days' => ['required'],
                    'start_time' => ['required'],
                    'end_time' => ['required'],
                    'subject_id' => 'required|integer',
                    'teacher_id'=> 'required|integer',
                    'year' => 'required',
                    'section' => 'required',
                    'class_size' => 'integer',
                    'status' => 'boolean'
                ],
            [
                'teacher_id.required' => 'The instructor field is required',
                'subject_id.required' => 'The subject field is required'
            ]);
                
             $start_time = $request->input('start_time');
             $end_time = $request->input('end_time');
             $days = $request->input('days');
             $section_field = $request->input('section');
             $room_no = $request->input('room_no');

            $alloc = $this->allocate_classroom->daysAndTimeOverlaps($start_time, $end_time , $days, $room_no, $section);

            
           if($alloc){
                return redirect('section/' . $section->id . '/show')
                ->with('error','sorry , day and time overlaps, choose other schedule');
           }else{
            $sub = $this->subjects->find($request->input('subject_id'));
           

            $section->allocate_classroom()->create($data + [
                'lec' => $sub->lec * count($section_field),
                'lab'=> $sub->lab * count($section_field),
                'unit' => $sub->unit * count($section_field),
                'course_id' => $course_id
                ]);
               
               return redirect('section/' . $section->id . '/show')
           ->with('success','allocate of room create successfully');
           }
          
        }
                
        $data['subjects'] = $this->subjects->latest()->get();
        $data['instructors'] = $this->instructors->latest()->get();
        $data['modify'] = 0;
        $data['days'] = $this->days;
        $data['rooms'] = $this->rooms;
        $data['section_id'] = $section->id;
        $data['year'] = $this->year;
        $data['section'] = $this->section;
        $data['class_size'] = $this->class_size;
        return view('admin.allocate_classroom.form', $data);
    }
 
    
    public function showAllocateClassRoom(Request $request, $id)
    {
        $data = [];
        $data['modify'] = 1;
        $data['allocate_classroom_id'] = $id;

        $data['allocate_classroom'] = $this->allocate_classroom->find($id);
        $data['subjects'] = $this->subjects->latest()->get();
        $data['instructors'] = $this->instructors->latest()->get();
        $data['days'] = $this->days;
        $data['rooms'] = $this->rooms;
        $data['section_id'] = $data['allocate_classroom']->section_id;
        $data['year'] = $this->year;
        $data['section'] = $this->section;
        $data['class_size'] = $this->class_size;
        return view('admin.allocate_classroom.form', $data);
    }

    public function updatellocateClassRoom(Request $request, $id, Section $section)
    {

        $data = [];

        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'room_no' => 'required',    
                'days' => ['required'],
                'start_time' => ['required'],
                'end_time' => ['required'],
                'subject_id' => 'integer',
                'teacher_id'=> 'integer',
                'year' => 'required',
                'section' => 'required',
                'class_size' => 'integer',
                'status' => 'boolean'
            ],      
            [
                'teacher_id.required' => 'The instructor field is required',
                'subject_id.required' => 'The subject field is required'
            ]);

            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');
            $days = $request->input('days');
            $section_field = $request->input('section');
            $room_no = $request->input('room_no');

            $alloc = $this->allocate_classroom->daysAndTimeOverlaps($start_time, $end_time , $days, $room_no, $section);

            
           if($alloc){
                return redirect('section/' . $section->id . '/show')
                ->with('error','sorry , day and time overlaps, choose other schedule');
           }else{
            $sub = $this->subjects->find($request->input('subject_id'));

           
            $this->allocate_classroom->find($id)->update($data + [
                'lec' => $sub->lec * count($section_field),
                'lab'=> $sub->lab * count($section_field),
                'unit' => $sub->unit * count($section_field),
                ]);

            $section_id = $this->allocate_classroom->find($id);
                
            return redirect('section/' . $section_id->section_id . '/show')
        ->with('success','allocated  room Update successfully');
        }
    }
    }
    public function deleteAllocateClassRoom($id){

        $this->allocate_classroom->find($id)->delete($id);
        $section_id = $this->allocate_classroom->find($id);

        return redirect('section/'. $section_id . '/show')
        ->with('success','Allocation of room deleted successfully');
    }
}
