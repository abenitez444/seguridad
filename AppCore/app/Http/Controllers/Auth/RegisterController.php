<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'country' => ['required'],
            'password' => ['required', 'string', 'min:6', 'max:15', 'confirmed'],
        ],
        [
            'name.required' => 'El campo name debe ser completado',
            'email.required' => 'El email debe ser completado.',
            'email.email' => 'El email enviado es inválido.',
            'email.unique' => 'El email ya se encuentra registrado.',
            'password.required' => 'La conraseña debe ser completada.',
            'password.min' => 'La contraseña debe tener un mínimo de 6 carácteres.',
            'password.max' => 'La contraseña debe tener un máximo de 15 carácteres.',
            'password.confirmed' => 'La contraseña no coinciden.',
            'phone.required' => 'El teléfono debe ser completado.',
            'country.required' => 'El país de residencia debe ser completado.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'state' => $data['state'],
            'codePostal' => $data['codePostal'],
            'is_active' => 1,
        ]);
    }
}
