<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

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
    protected $redirectTo = '/dash';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $user = User::where('username', $request->username)
        ->where('password',md5($request->password))
        ->first();

        if(!empty($user)){
            Auth::login($user);
            return redirect('/dash');
        }else{
            return redirect('/login');
        }

        // if(auth()->attempt(['username' => $request->username, 'password' => $request->password])){
        //     if (!empty($user)) {
        //         Auth::login(($user));
        //     }
        //     return redirect()->intended('/dash');
        // }
        return redirect()->back()->with(['error' => 'password Invalid / Inactive Users']);


    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
