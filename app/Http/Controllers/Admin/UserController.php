<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(User $users)
    {
        $this->middleware('permission:user-list', ['only' => ['getUsers','deleteUser','showUser']]);
        $this->middleware('permission:user-create', ['only' => ['createUser']]);
        $this->middleware('permission:user-edit', ['only' => ['show','updateUser']]);
        $this->middleware('permission:user-delete', ['only' => ['deleteUser']]);
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
                        return view('admin.users.action', compact('row'))->render();
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
                'username' => 'required|unique:users',
                'password' => 'required|max:20',
                'roles' => 'required'
            ]);

          $user_role = $user->create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))
          ]);

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

            $this->validate($request, [
                'name' => 'required|max:255',
                'username' => 'required',
                'password' => 'sometimes|required|max:20',
                'roles' => 'required'
            ]);


            
            $this->users->find($id)->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password'))
                ]);
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
