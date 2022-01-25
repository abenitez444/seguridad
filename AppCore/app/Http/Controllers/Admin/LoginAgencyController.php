<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Agency;
use Illuminate\Support\Facades\Auth;


class LoginAgencyController extends Controller
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

   // protected $loginView = 'admin.agency.login-agency';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $guard = 'admins';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginFormAdmin()
    {
        return view('admin.agency.login-agency');
    }
    public function authenticated()
    {
        return redirect('/business/admins/area');
    }
    public function secret()
    {
        return 'Hola' . auth('admins')->user() . 'Correo' . auth('admins')->user()->id;
    }

    public function getAgency($request)
    {
    	$user = null;
    	$credentials = $this->credentials($request);

    	if (array_key_exists('email', $credentials)) {
    		$agency = Agency::where('email', $credentials['email'])->first();
    	} else if (array_key_exists('user', $credentials)) {
    		$agency = Agency::where('user', $credentials['user'])->first();
    	}

    	return $agency;
    }

    public function validateAdmin($request)
    {
    	$user = $this->getAgency($request);

    	if ($user === null) {
    		return false;
    	}

    	if ($user->is_admin) {
    		return true;
    	}

    	return false;
    }

    public function validateStatus($request)
    {
    	$user = $this->getAgency($request);

    	if ($user === null) {
    		return false;
    	}

    	if ($user->is_active) {
    		return true;
    	}

    	return false;
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function guard()
    {
        return Auth::guard('admins');
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if($request->ajax()){
        	$this->authenticated($request, $this->guard('admins'));
        	return response()->json(['success' => 1]);
        }
        return $this->authenticated($request, $this->guard('admins'))
                ?: redirect()->intended($this->redirectPath());
    }
    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    protected function sendFailedLogin(Request $request, $message = '')
    {
        return response()->json(['errors' => $message], 400);
    }
 
    public function login(Request $request)
    {
      
    	$this->validateLogin($request);

    	if ($this->getAgency($request) === null) {
            // return $this->sendFailedLoginResponse();
    		return $this->sendFailedLogin($request, 'Email no se encuentra registrado.');
    	}

    	/*if (!$this->validateAdmin($request)) {
            return $this->sendFailedLogin($request, 'Email no tiene los accesos permitidos.');
    	}*/
    	if (!$this->validateStatus($request)) {
            return $this->sendFailedLogin($request, 'Email no se encuentra activo.');
    	}    	

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        
        return $this->sendFailedLogin($request, 'Contraseña inválida');
       
    }
  
   
}
