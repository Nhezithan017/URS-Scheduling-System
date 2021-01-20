<?php

namespace App\Http\Controllers\Admin;

use App\DataContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use App\Subject;
use Yajra\DataTables\DataTables;
class SubjectController extends Controller
{
  
    public function __construct(Subject $subjects, DataContent $data_content)
    {
        $this->middleware('permission:subject-list', ['only' => ['getSubject','deleteSubject','showSubject']]);
        $this->middleware('permission:subject-create', ['only' => ['createSubject']]);
        $this->middleware('permission:subject-edit', ['only' => ['showSubject','updateSubject']]);
        $this->middleware('permission:subject-delete', ['only' => ['deleteSubject']]);

        $this->lec = $data_content->lec;
        $this->lab = $data_content->lab;
        $this->unit = $data_content->unit;
        $this->subjects = $subjects;
    }
    public function getSubject(Request $request){

        if ($request->ajax()) {
            $data = $this->subjects->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return view('admin.subjects.action', compact('row'))->render();
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.subjects.index');
    }

    public function createSubject(Request $request, Subject $subject)
    {
        $data = [];

        
        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'code' => 'required',
                'description' => 'required',
                'lec' => 'required',
                'lab' => 'integer',
                'unit' => 'required',

            ]);

          $subject->insert($data);

            return redirect('subjects')
        ->with('success','Subject create successfully');
        }

        $data['modify'] = 0;
        $data['lec'] = $this->lec;
        $data['lab'] = $this->lab;
        $data['unit'] = $this->unit;
    
        return view('admin.subjects.form', $data);
    }

    public function showSubject($id, Request $request)
    {
        $data = [];
        $data['modify'] = 1;
        $data['subject_id'] = $id;

        $data['subject'] = $this->subjects->find($id);

        $data['lec'] = $this->lec;
        $data['lab'] = $this->lab;
        $data['unit'] = $this->unit;
        
        return view('admin.subjects.form', $data);
    }
    public function updateSubject(Request $request, $id, Subject $subject)
    {

        $data = [];

        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'code' => 'required',
                'description' => 'required',
                'lec' => 'required',
                'lab' => 'integer',
                'unit' => 'required',
            ]);


            
            $this->subjects->find($id)->update($data);

            return redirect('subjects')
        ->with('success','Subject Update successfully');
        }
    }

    public function deleteSubject($id){

        $this->subjects->find($id)->delete($id);

        return redirect()->route('subject.index')
        ->with('success','Subject deleted successfully');
    }
}
