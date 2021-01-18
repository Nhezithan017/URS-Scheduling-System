<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use DB;
use Yajra\DataTables\Facades\DataTables;
class RoleController extends Controller
{
   public function __construct()

    {

     //     $this->middleware('permission:role-list', ['only' => ['getRoles']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);


    }
    public function getRoles(Request $request){

     if ($request->ajax()) {
         $data = Role::all();
         return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                     $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                         <a href="' . route('user.show', $row->id)  .'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                         <input type="hidden" value="'. $row->id .'" id="userId"/>
                         <button type="button" name="deleteButton" id="' . $row->id . '" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
                     </div>';

                         // '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                         return $btn;
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

      $role = $role->create(['name' => $request->input('name')]);

      $role->syncPermissions($request->input('permission'));
        return redirect('roles')
    ->with('success','Role create successfully');
    }

    $data['modify'] = 0;
    $data['roles'] = Role::pluck('name', 'name')->all();
    $data['permission'] = Permission::get();

    return view('admin.users.form', $data);
}

public function showUser($id, Request $request)
{
    $data = [];
    $data['modify'] = 1;
    $data['user_id'] = $id;

    $data['user'] = $this->users->find($id);
     $data['permission'] = Permission::get();
    $data['roles'] = Role::pluck('name', 'name')->all();
    $data['user_role'] = $data['user']->roles->pluck('name','name')->all();

    return view('admin.users.form', $data);
}
public function updateUser(Request $request, $id, User $user)
{

    $data = [];

    if($request->isMethod('post')){

        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required',
            'password' => 'sometimes|required|max:20'
        ]);


        
        $this->users->find($id)->update($data);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $this->users->find($id)->assignRole($request->input('roles'));

        return redirect('users')
    ->with('success','User Update successfully');
    }
}

public function deleteUser($id){

    $this->users->find($id)->delete($id);

    return redirect()->route('users.index')
    ->with('success','User deleted successfully');
}
}