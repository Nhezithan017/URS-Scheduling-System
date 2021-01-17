<?php


namespace App\Http\Controllers\Admin;

use App\AllocateClassroom;
use App\DataContent;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\TimeOverlap;
use App\Subject;
use Yajra\DataTables\DataTables;


class AllocateClassroomController extends Controller
{
    public function __construct(AllocateClassroom $allocate_classroom, Subject $subjects, DataContent $data_content)
    {
        $this->allocate_classroom = $allocate_classroom;
        $this->subjects = $subjects;
        $this->days = $data_content->days;
    }
    public function createAllocateClassRoom(Request $request, Section $section)
    {
        $data = [];

        
            if($request->isMethod('post')){

                $data = $this->validate($request, [
                    'room_no' => 'required',
                    'teacher' => 'required',
                    'days' => ['required', new TimeOverlap()],
                    'start_time' => ['required', new TimeOverlap()],
                    'end_time' => ['required', new TimeOverlap()],
                    'subject_id' => 'integer'
                ]);

                $section->allocate_classroom()->create($data);
                
                return redirect('section/' . $section->id . '/show')
            ->with('success','allocate of room create successfully');
            
                }
        $data['section_id'] = $section->id;

        $data['subjects'] = $this->subjects->latest()->get();
        
        $data['modify'] = 0;
        $data['days'] = $this->days;

        
        return view('admin.allocate_classroom.form', $data);
    }
 

    public function showAllocateClassRoom(Request $request, $id)
    {
        $data = [];
        $data['modify'] = 1;
        $data['allocate_classroom_id'] = $id;

        $data['allocate_classroom'] = $this->allocate_classroom->find($id);
        $data['subjects'] = $this->subjects->latest()->get();
        $data['days'] = $this->days;
        
        return view('admin.allocate_classroom.form', $data);
    }

    public function updatellocateClassRoom(Request $request, $id, Section $section)
    {

        $data = [];

        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'room_no' => 'required',
                'teacher' => 'required',
                'days' => ['required'],
                'start_time' => ['required'],
                'end_time' => ['required'],
                'subject_id' => 'integer'
            ]);


            
            $this->allocate_classroom->find($id)->update($data);

            $section_id = $this->allocate_classroom->find($id);
                
            return redirect('section/' . $section_id->section_id . '/show')
        ->with('success','allocated  room Update successfully');
        }
    }
}
