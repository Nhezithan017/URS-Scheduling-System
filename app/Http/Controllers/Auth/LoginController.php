<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';    

    protected function username(){
        return 'username';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function loginForm(){

        return view('auth.login');
    }
    public function authenticated(){
        event(new \App\Events\UserEvent(Auth::user(), 'Authentication', 'Successfully logged in.'));
    }
    public function logout(Request $request)
    {
        event(new \App\Events\UserEvent(Auth::user(), 'Authentication', 'Successfully logged out.'));
        $this->guard()->logout();

       
        $request->session()->invalidate();
        
        return $this->loggedOut($request) ?: redirect('/');
    }
 
  
}
