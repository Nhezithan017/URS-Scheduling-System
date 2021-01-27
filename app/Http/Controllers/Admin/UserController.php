<?php

namespace App\Http\Controllers\Admin;

use App\AllocateClassroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use App\User;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use UploadTrait;

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

        
        

    
        $data['roles'] = Role::pluck('name', 'name')->all();
        return view('admin.users.create', $data);
    }
    public function insertUser(Request $request)
    {
        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'name' => 'required|max:255',
                'username' => 'required|unique:users',
                'password' => 'required|max:20',
                'roles' => 'required',
                'profile_image'  =>  'mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = new User;

            $user->name = $request->input('name');
            $user->username =  $request->input('username');
            $user->password = Hash::make($request->input('password'));
     
            if ($request->has('profile_image')) {
                // Get image file
                $image = $request->file('profile_image');
            
                // Make a image name based on user name and current timestamp
                $name = Str::slug($request->input('name')).'_'.time();
                // Define folder path
                $folder = '/uploads/user_images/';
                // Make a file path where image will be stored [ folder path + file name + file extension]
                $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
                // Upload image
                $this->uploadOne($image, $folder, 'public', $name);
                // Set user profile image path in database to filePath
                $user->profile_image = $filePath;
            }
          
    
            $user->save();

          $user->assignRole($request->input('roles'));
            return redirect('users')
        ->with('success','User create successfully');
          }
    }
    public function showUser($id, Request $request)
    {
        $data = [];
        $data['modify'] = 1;
        $data['user_id'] = $id;

        $data['user'] = $this->users->find($id);

        $data['roles'] = Role::pluck('name', 'name')->all();
        $data['user_role'] = $data['user']->roles->pluck('name','name')->all();

        return view('admin.users.edit', $data);
    }
    public function updateUser(Request $request, $id, User $user)
    {

        $data = [];

        if($request->isMethod('post')){

           $data =  $this->validate($request, [
                'name' => 'required|max:255',
                'username' => 'required',
                'password' => 'nullable|max:20|',
                'roles' => 'required',
                'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

         
        $input = $request->all();
            
        $user =  $this->users->find($id);

        if(!is_null($input['password'])) {
            $user->password = Hash::make($input['password']);
        }
    

         

        $user->name = $input['name'];
        $user->username =  $input['username'];

        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
        
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/user_images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->deleteOne($user->profile_image);
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }

        $user->save();

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
