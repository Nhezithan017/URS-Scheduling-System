<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;
use Barryvdh\DomPDF\PDF;
use Yajra\DataTables\Facades\DataTables;    
class TeacherController extends Controller
{
    public function __construct(Teacher $instructors)
    {
        $this->middleware('permission:instructor-list', ['only' => ['getInstructor','deleteInstructor','showInstructor']]);
        $this->middleware('permission:instructor-create', ['only' => ['createInstructor']]);
        $this->middleware('permission:instructor-edit', ['only' => ['showInstructor','updateInstrutor']]);
        $this->middleware('permission:instructor-delete', ['only' => ['deleteInstructor']]);
        $this->instructors = $instructors;
    }
    public function print($id)
    {
        $pdf = app('dompdf.wrapper');


        
        $pdf->getDomPDF()->set_option("enable_php", true);

       $instructor =  $this->instructors->find($id);

        $pdf->loadView('admin.instructors.print', compact('instructor'))->setPaper('a4', 'landscape');

            
       return $pdf->stream('invoice.pdf');
    }
    public function getInstructor(Request $request){

        if ($request->ajax()) {
            $data = $this->instructors->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return view('admin.instructors.action', compact('row'))->render();
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
