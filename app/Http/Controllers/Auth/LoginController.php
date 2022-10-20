<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


   protected function sendLoginResponse(Request $request)
    {
    $request->session()->regenerate();
    $previous_session = Auth::User()->session_id;
    if ($previous_session) {
        \Session::getHandler()->destroy($previous_session);
    }

    Auth::user()->session_id = \Session::getId();
    Auth::user()->save();
    $this->clearLoginAttempts($request);

    return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
     {
     $login = $request->input($this->username());

    // Comprobar si el input coincide con el formato de E-mail
     $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'Dni';

        return [$field => $login,'password' => $request->input('password')];
     }

    public function username()
     {
        return 'login';
     }

}
