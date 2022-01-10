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
use App\Roles;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.superadmin');
    }

    public function index()
    {
        return view('admin.users');
    }

    public function getAllWithPagination(Request $request){
        $per_page = 50;
        if ($request->has('per_page') && $request->per_page == 'all') {
            $per_page = User::where('is_superadmin', '0')->count();
        } else {
            $per_page = $request->per_page;
        }
        $users = User::where('is_superadmin', '0')->orderBy('name', 'ASC')->paginate($per_page);
        foreach ($users as &$user) {
            $user->roles = $user->roles()->get();
        }
        return $users;
    }

    public function getAllRoles()
    {
        return Roles::all();
    }

    public function store(Request $request)
    {
        // return $request->all();
        $rules = $this->rules();
        $rules['password'] = ['required', 'min:6'];
        $rules['type'] = ['required'];

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
            $user = new User;
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->dni = $request->dni;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->postal_code = '0000';
            // $2y$10$vakYVE9sTUEdHDbNBL2I9ON7Xz10xJSMJLZpzGjCO7/Hxcy6brkKC
            if (isset($request->password) && $request->password != '' && $request->password != null) {
                if ($request->password != $request->password2) {
                    return response()->json(['errors' => ['message' => ['password' => 'Las contraseña no coinciden']]], 400);
                }
                $user->password = Hash::make($request->password);
            }
            $user->type = $request->type;        
            $user->is_active = ($request->has('is_active')) ? 1 : 0;

            if ($request->hasFile('image')) {
                $image_name = 'porfile-'.strtotime('now').'.'.$request->image->getClientOriginalExtension();
                $path = $request->image->storeAs('user', $image_name, 'public');
                $user->image = $path;
            }
            $user->save();

            if ($request->has('roles') && count($request->roles) > 0) {
                $users_has_roles = [];
                foreach ($request->roles as $rol) {
                    array_push($users_has_roles, ['users_id' => $user->id, 'roles_id' => $rol]);
                }
                DB::table('users_has_roles')->insert($users_has_roles);
            }

            DB::commit();
            return response()->json(['success' => '1', 'id_user' => $user->id]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['errors' => ['message' => $e->getMessage(), 'line' => $e->getLine()]], 400);
        }
    }

    public function updateUser(Request $request, $id)
    {
        // return $request->all();
        $rules = $this->rules($id);       

        $messages = $this->messageValidation();

        $validation = Validator::make($request->all(), $rules, $messages);
        if (!$validation->passes()) {
            return response()->json(['errors' => $validation->errors()], 400);
        }
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->dni = $request->dni;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->postal_code = '0000';
            $user->type = $request->type;
            $user->is_active = ($request->has('is_active')) ? 1 : 0;
            // $2y$10$vakYVE9sTUEdHDbNBL2I9ON7Xz10xJSMJLZpzGjCO7/Hxcy6brkKC
            if (isset($request->password) && $request->password != '********' && $request->password != null) {
                if ($request->password != $request->password2) {
                    return response()->json(['errors' => ['message' => ['password' => 'Las contraseña no coinciden']]], 400);
                }
                $user->password = Hash::make($request->password);
            }

            if ($request->has('changeImage')) {
                $old_image = $user->image;
                $user->image = 'user/avatar0.jpg';
            }

            if ($request->hasFile('image')) {
                if (!isset($old_image)) {
                    $old_image = $user->image;
                }                
                $image_name = 'porfile-'.strtotime('now').'.'.$request->image->getClientOriginalExtension();
                $path = $request->image->storeAs('user', $image_name, 'public');
                $user->image = $path;
            }
            $user->update();

            DB::table('users_has_roles')->where('users_id', $user->id)->delete();
            if ($request->has('roles') && count($request->roles) > 0) {
                $users_has_roles = [];
                foreach ($request->roles as $rol) {
                    array_push($users_has_roles, ['users_id' => $user->id, 'roles_id' => $rol]);
                }
                DB::table('users_has_roles')->insert($users_has_roles);
            }
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

    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);

            if ($user->image != 'user/avatar0.jpg') {
                $old_image = $user->image;
            }
            
            $user->delete();
            DB::commit();
            if (isset($old_image)) {
                Storage::disk('public')->delete($old_image);
            }
            return response()->json(['success' => '1']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['errors' => ['messages' => $e->getMessage(), 'line' => $e->getLine()]], 400);
        }
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
