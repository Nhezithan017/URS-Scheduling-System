<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        
    }
    public function getUsers(Request $request){

        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary"><i class="fas fa-eye"></i></button>
                            <a href="' . route('user.edit', $row->id)  .'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <input type="hidden" value="'. $row->id .'" id="userId"/>
                            <button type="button" name="deleteButton" id="' . $row->id . '" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
                        </div>';

                            // '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.users.index');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    public function createUser()
    {
        return view('admin.users.create');
    }
    public function insertUser(Request $request){
        $data = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'email' =>  'required|email|unique:users',
            'password' => 'required|max:20'
        ]);

        User::create($data);


        return redirect()->route('users.index')
        ->with('success','User create successfully');

    }
    public function updateUser(Request $request, User $user){

        $data = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'email' =>  'required|email|unique:users,email,'.$user->id.',id'
        ]);
      
        
       
         $user->update($data);

         return redirect()->route('users.index')
         ->with('success','User updated successfully');
    }
    public function deleteUser($id){

        User::find($id)->delete($id);

        return redirect()->route('users.index')
        ->with('success','User deleted successfully');
    }
}
