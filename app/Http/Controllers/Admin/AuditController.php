<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;
class AuditController extends Controller
{
    public function __construct(Activity $activity)
    {
        $this->middleware('permission:audit-list', ['only' => ['getAudit']]);
        $this->activity = $activity;
    }
    public function getAudit(Request $request){

        if ($request->ajax()) {
            $data = $this->activity->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('username', function($row){
                       $username = User::find($row->causer_id)->username;

                       return $username;
                 })
                    ->addColumn('time', function($row){
                           return $row->created_at->diffForHumans();
                    })
                    ->rawColumns(['username'])
                    ->rawColumns(['time'])
                    ->make(true);
        }

        return view('admin.audit.index');
    }
}
