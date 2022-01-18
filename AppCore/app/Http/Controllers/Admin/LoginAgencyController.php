<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Agency;



class LoginAgencyController extends Controller
{
    
    use AuthenticatesUsers;
    protected $guard = 'business';
    public function showLoginFormAdmin()
    {
        return view('admin.agency.login-agency');
        
    }
    public function getAgency($request)
    {
    	$agency = null;
    	$credentials = $this->credentials($request);

    	if (array_key_exists('email', $credentials)) {
    		$agency = Agency::where('email', $credentials['email'])->first();
    	} else if (array_key_exists('agency', $credentials)) {
    		$agency = Agency::where('password', $credentials['password'])->first();
    	}

    	return $agency;
    }

    public function validateAdmin($request)
    {
    	$agency = $this->getAgency($request);

    	if ($agency === null) {
    		return false;
    	}

    	if ($agency->is_admin) {
    		return true;
    	}

    	return false;
    }

    public function validateStatus($request)
    {
    	$agency = $this->getAgency($request);

    	if ($agency === null) {
    		return false;
    	}

    	if ($agency->is_active) {
    		return true;
    	}

    	return false;
    }

    /**
     * Send the response after the agency was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if($request->ajax()){
        	$this->authenticated($request, $this->guard()->user());
        	return response()->json(['success' => 1]);
        }
        return $this->authenticated($request, $this->guard()->user())
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

  /*       $user = new User();
         $user->name = 'Mauricio';
         $user->last_name= 'root';
    $user->email = 'mauricio.b.o@hotmail.com';
    $user->password = Hash::make('123456');
    $user->phone = '676575';
    $user->type = '0';
    $user->address='000000';
    $user->is_active = 1;
    $user->is_admin = 0;
    $user->is_superadmin = 1;
    $user->cellular = '0000';
    $user->postal_code = '00000';
    $user->dni = '0000';
    $user->save();
*/
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
