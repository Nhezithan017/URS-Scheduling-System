<?php


namespace App\Http\Controllers\Admin;

use App\AllocateClassroom;
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
        $this->instructors = $instructors;
    }
    public function createAllocateClassRoom(Request $request, Section $section)
    {
        $data = [];

        $sectionid = $section->id;

            if($request->isMethod('post')){

                $data = $this->validate($request, [
                    'room_no' => 'required',
                    'days' => ['required'],
                    'start_time' => ['required'],
                    'end_time' => ['required'],
                    'subject_id' => 'required|integer',
                    'teacher_id'=> 'required|integer',
                    'status' => 'boolean'
                ],
            [
                'teacher_id.required' => 'The instructor field is required',
                'subject_id.required' => 'The subject field is required'
            ]);
                
             $start_time = $request->input('start_time');
             $end_time = $request->input('end_time');
             $days = $request->input('days');
                    
            //  $this->allocate_classroom->daysAndTimeOverlaps($start_time, $end_time, $days, $sectionid);
             $section->allocate_classroom()->create($data);
                
                return redirect('section/' . $section->id . '/show')
            ->with('success','allocate of room create successfully');
            
                }
                
        $data['subjects'] = $this->subjects->latest()->get();
        $data['instructors'] = $this->instructors->latest()->get();
        $data['modify'] = 0;
        $data['days'] = $this->days;
        $data['rooms'] = $this->rooms;
        $data['section_id'] = $section->id;

        
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
                'status' => 'boolean'
            ],      
            [
                'teacher_id.required' => 'The instructor field is required',
                'subject_id.required' => 'The subject field is required'
            ]);


            
            $this->allocate_classroom->find($id)->update($data);

            $section_id = $this->allocate_classroom->find($id);
                
            return redirect('section/' . $section_id->section_id . '/show')
        ->with('success','allocated  room Update successfully');
        }
    }
    public function deleteAllocateClassRoom($id){

        $this->allocate_classroom->find($id)->delete($id);
        $section_id = $this->allocate_classroom->find($id);

        return redirect('section/'. $section_id . '/show')
        ->with('success','Allocation of room deleted successfully');
    }
}
