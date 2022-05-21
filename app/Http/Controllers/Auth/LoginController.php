<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm()
    {
      return view('auth.login');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function login(Request $request)
    {
        $credentials=$request->only('username', 'password');
        $user_type=$request->only('type');
        
        //qui si possono fare una serie di if a cascata per ogni utente
        if(Auth::attempt($credentials)){
            //autenticazione passata
            switch($user_type){
                default:
                    return redirect()->route('home');
                case "Ricercatore":
                   
                   break;
                case "Manager":
                    
                    break;
                case "Finanziatore":
                    
                    break;
            }
            

        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
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
}
