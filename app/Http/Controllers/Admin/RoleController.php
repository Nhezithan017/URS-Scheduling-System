<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class RoleController extends Controller
{
   public function __construct(Role $roles)

    {

        //  $this->middleware('permission:role-list', ['only' => ['getRoles','deleteRole','showRole']]);
        //  $this->middleware('permission:role-create', ['only' => ['createRole']]);
        //  $this->middleware('permission:role-edit', ['only' => ['showRole','updateRole']]);
        //  $this->middleware('permission:role-delete', ['only' => ['deleteRole']]);
        $this->roles = $roles;

    }
    public function getRoles(Request $request){

     if ($request->ajax()) {
         $data = Role::all();
         return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                    return view('admin.roles.action', compact('row'))->render();
                 })
                 ->rawColumns(['action'])
                 ->make(true);
     }


     return view('admin.roles.index');
}

public function createRole(Request $request, Role $role)
{
    $data = [];

    
    if($request->isMethod('post')){

        $data = $this->validate($request, [
          'name' => 'required|unique:roles,name',
          'permission' => 'required',
        ]);

      $role_permission = $role->create(['name' => $request->input('name')]);

      $role_permission->syncPermissions($request->input('permission'));
        return redirect('roles')
    ->with('success','Role create successfully');
    }

    $data['modify'] = 0;
    $data['roles'] = Role::pluck('name', 'name')->all();
    $data['permission'] = Permission::get();


    

    return view('admin.roles.form', $data);
}

public function showRole($id, Request $request)
{
    $data = [];
    $data['modify'] = 1;
    $data['role_id'] = $id;

    $data['role'] = $this->roles->find($id);
    
    $data['permission'] = Permission::get();
    $data['roles'] = Role::pluck('name', 'name')->all();
   

    $data['role_permissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
    ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    ->all();

    return view('admin.roles.form', $data);
}
public function updateRole(Request $request, $id, Role $role)
{

    $data = [];

    if($request->isMethod('post')){

        $data = $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = $this->roles->find($id);

        $role->name  = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        
       
        return redirect('roles')
    ->with('success','Role Update successfully');
    }   
}

public function deleteRole($id){

    $this->roles->find($id)->delete($id);

    return redirect()->route('role.index')
    ->with('success','Role deleted successfully');
}
}