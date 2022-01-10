<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
use DB;
use App\User;
use App\Clients;
use App\Watchmen;
use App\Assignment;

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $clients = Clients::all()->count();
        $watchmen = Watchmen::all()->count();
        $assignment = Assignment::all()->count();

        return view('admin.dashboard', ['clients' => $clients, 'watchmen' => $watchmen, 'assignment' => $assignment]);
    }

    public function showProfile()
    {
        return view('admin.showProfile');
    }

    public function getProfile()
    {
        $user = auth()->user();
        return $user;
    }

    public function updateProfile(Request $request)
    {
        // return $request->all();
        $rules = $this->rules(auth()->user()->id);

        if ($request->has('changePassword') && $request->changePassword == 1) {
            $rules['password'] = ['required', 'min:6'];
            // $rules['type'] = ['required'];
        }        

        $messages = $this->messageValidation();
        $addMsg = [
            'password.required' => 'La contraseña debe ser completada',
            'password.min' => 'La contraseña debe tener un mínimo de 6 carácteres',
            'type' => 'El tipo de usuario debe ser completado',
        ];
        array_push($messages, $addMsg);

        $validation = Validator::make($request->all(), $rules, $messages);
        if (!$validation->passes()) {
            return response()->json(['errors' => $validation->errors()], 400);
        }
        try {
            DB::beginTransaction();
            $user = User::find(auth()->user()->id);
            $user->name = $request->name;
            $user->dni = $request->dni;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->last_name = $request->last_name;
            $user->postal_code = $request->postal_code;
            // $2y$10$vakYVE9sTUEdHDbNBL2I9ON7Xz10xJSMJLZpzGjCO7/Hxcy6brkKC
            if ($request->has('changePassword') && $request->changePassword == 1) {
                if (isset($request->password) && $request->password != '' && $request->password != null) {
                    if ($request->password != $request->password2) {
                        return response()->json(['errors' => ['message' => ['password' => 'Las contraseña no coinciden']]], 400);
                    }
                    $user->password = Hash::make($request->password);
                }
            }
            // $user->type = $request->type;        
            // $user->is_active = (isset($request->is_active) && $request->is_active == 1) ? 1 : 0;

            if ($request->hasFile('image')) {
                $old_image = $user->image;
                $image_name = 'porfile-'.strtotime('now').'.'.$request->image->getClientOriginalExtension();
                $path = $request->image->storeAs('user', $image_name, 'public');
                $user->image = $path;
            }
            $user->update();
            DB::commit();
            if (isset($old_image)) {
                Storage::disk('public')->delete($old_image);
            }
            return response()->json(['success' => '1', 'id_user' => $user->id]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['errors' => ['message' => $e->getMessage(), 'line' => $e->getLine()]], 400);
        }
    }

    public function assignment(Request $request)
    {
        return view('admin.assignment');
    }

    public function rules($id = '')
    {
        $rules = [
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'dni' => ['required', Rule::unique('users')->ignore($id)],
            'name' => ['required', 'string'],
        ];
        return $rules;
    }

    public function messageValidation()
    {
        $messages = [
            'name.required' => 'El nombre debe ser definido.',
            'email.required' => 'El email debe ser completado.',
            'email.email' => 'El email enviado es inválido.',
            'email.unique' => 'El email ya se encuentra registrado.',
            'dni.unique' => 'La cédula de identidad ya se encuentra registrada.',
            'phone.required' => 'El teléfono debe ser completado',
        ];
        return $messages;
    }
}
