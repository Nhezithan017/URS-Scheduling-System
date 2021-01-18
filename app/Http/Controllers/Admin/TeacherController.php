<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;
use Yajra\DataTables\Facades\DataTables;    
class TeacherController extends Controller
{
    public function __construct(Teacher $instructors)
    {
        $this->instructors = $instructors;
    }
    public function getInstructor(Request $request){

        if ($request->ajax()) {
            $data = $this->instructors->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="' . route('instructor.show', $row->id)  .'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <input type="hidden" value="'. $row->id .'" id="userId"/>
                            <button type="button" name="deleteButton" id="' . $row->id . '" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
                        </div>';

                            // '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.instructors.index');
    }

    public function createInstructor(Request $request, Teacher $instructor)
    {
        $data = [];

        
        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'name' => 'required',
                'degree' => 'required',
                'educ_status' => 'required',
                'position_title' => 'string',
                'nature_of_appoint' => 'string'
            ]);

          $instructor->insert($data);

            return redirect('instructors')
        ->with('success','Instructor create successfully');
        }

        $data['modify'] = 0;
    
        return view('admin.instructors.form', $data);
    }

    public function showInstructor($id, Request $request)
    {
        $data = [];
        $data['modify'] = 1;
        $data['instructor_id'] = $id;

        $data['instructor'] = $this->instructors->find($id);

    
        
        return view('admin.instructors.form', $data);
    }
    public function updateInstructor(Request $request, $id, Teacher $instructor)
    {

        $data = [];

        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'name' => 'required',
                'degree' => 'required',
                'educ_status' => 'required',
                'position_title' => 'string',
                'nature_of_appoint' => 'string'
            ]);


            
            $this->instructors->find($id)->update($data);

            return redirect('instructors')
        ->with('success','Instructor Update successfully');
        }
    }

    public function deleteInstructor($id){

        $this->instructors->find($id)->delete($id);

        return redirect()->route('instructor.index')
        ->with('success','Instructor deleted successfully');
    }
}
