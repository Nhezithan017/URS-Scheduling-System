<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(User $users)
    {
        $this->users = $users;
    }
    public function getUsers(Request $request){

        if ($request->ajax()) {
            $data = $this->users->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('role', function($row){
                            foreach($row->getRoleNames() as $v){
                                return $v;
                            }
                        
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="' . route('user.show', $row->id)  .'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <input type="hidden" value="'. $row->id .'" id="userId"/>
                            <button type="button" name="deleteButton" id="' . $row->id . '" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
                        </div>';

                            // '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['role'])
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.users.index');
    }

    public function createUser(Request $request, User $user)
    {
        $data = [];

        
        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'name' => 'required|max:255',
                'username' => 'required',
                'password' => 'required|max:20',
                'roles' => 'required'
            ]);

          $user_role = $user->insert($data);
          $user_role->assignRole($request->input('roles'));
            return redirect('users')
        ->with('success','User create successfully');
        }

        $data['modify'] = 0;
        $data['roles'] = Role::pluck('name', 'name')->all();
        return view('admin.users.form', $data);
    }

    public function showUser($id, Request $request)
    {
        $data = [];
        $data['modify'] = 1;
        $data['user_id'] = $id;

        $data['user'] = $this->users->find($id);

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
