<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;
use DB;
use App\Watchmen;
use App\Shifts;
use App\Clients;
use App\Assignment;
use App\News;

class WatchmenController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
        $this->middleware('role:list_watchmen')->only(['index', 'getAllWithPagination']);
        $this->middleware('role:create_watchmen')->only(['store']);
        $this->middleware('role:edit_watchmen')->only(['update']);
        $this->middleware('role:delete_watchmen')->only(['destroy']);
	}

    public function index()
    {
        return view('admin.watchmen');
    }

    public function getAllWithPagination(Request $request)
    {
        $per_page = 100;
        if ($request->has('per_page') && $request->per_page == 'all') {
            $per_page = Watchmen::all()->count();
        } else {
            $per_page = $request->per_page;
        }
        $vigilant = Watchmen::where('is_delete', 0)->paginate($per_page);
        foreach ($vigilant as &$v) {
            $v->assignment = $v->assignment()->get();
            $clients_activated = [];
            foreach ($v->assignment as $assig) {
                if ($assig->pivot->is_active == 1) {
                    array_push($clients_activated, Clients::find(Assignment::find($assig->pivot->assignment_id)->clients_id));
                }
            }

            $news_w = DB::table('watchmen_has_news')->where('watchmen_id', $v->id)->where('is_principal', '0')->get();
            $clients_activated_news = [];
            foreach ($news_w as $n) {
                $novelty = News::find($n->news_id);
                if ($novelty->clients_id != null && is_numeric($novelty->clients_id)) {
                    $client = Clients::find($novelty->clients_id);
                    $client->novelty = $novelty;
                    array_push($clients_activated_news, $client);
                }
            }

            $v->clients_activated = $clients_activated;
            $v->clients_activated_news = $clients_activated_news;
        }

        return $vigilant;
    }

    public function getAllActivated()
    {
        $watchmen = Watchmen::where('is_delete', 0)->where('is_active', '1')->where('i_quit', '0')->where('is_dismissal', '0')->where('is_disconnected', '0')->orderBy('name', 'ASC')->get();
        foreach ($watchmen as &$w) {
            $w->assignment = $w->assignment()->get();
            $clients_activated = [];
            foreach ($w->assignment as $assig) {
                $assig->shift = Shifts::find($assig->pivot->shifts_id);
                if ($assig->pivot->is_active == 1) {
                    array_push($clients_activated, Clients::find(Assignment::find($assig->pivot->assignment_id)->clients_id));
                }
            }
            $w->clients_activated = $clients_activated;
        }
        return $watchmen;
    }

    public function getAll()
    {
        $watchmen = Watchmen::orderBy('name', 'ASC')->get();
        foreach ($watchmen as &$w) {
            // $assignment = $w->assignment()->get();
            if (!$w->activated_in_assignment()) {
                $w->has_assignment = 0;
            } else {
                $w->has_assignment = 1;
            }
            $w->assignment = $w->assignment()->get();
            $clients_activated = [];
            foreach ($w->assignment as $assig) {
                $assig->shift = Shifts::find($assig->pivot->shifts_id);
                if ($assig->pivot->is_active == 1) {
                    array_push($clients_activated, Clients::find(Assignment::find($assig->pivot->assignment_id)->clients_id));
                }
            }
            
            $news_w = DB::table('watchmen_has_news')->where('watchmen_id', $w->id)->where('is_principal', '0')->get();
            $clients_activated_news = [];
            foreach ($news_w as $n) {
                $novelty = News::find($n->news_id);
                if ($novelty->clients_id != null && is_numeric($novelty->clients_id)) {
                    $client = Clients::find($novelty->clients_id);
                    $client->novelty = $novelty;
                    $client->novelty->assignment = $novelty->assignment()->first();
                    $client->novelty->assignment->pivot = DB::table('assignment_as_watchmen')->where('assignment_id', $client->novelty->assignment->id)->first();
                    $client->novelty->assignment->shift = Shifts::find($client->novelty->assignment->pivot->shifts_id);
                    array_push($clients_activated_news, $client);
                }
            }

            $w->clients_activated = $clients_activated;
            $w->clients_activated_news = $clients_activated_news;
        }
        return $watchmen;
    }

    public function getAllFree()
    {
        $list = [];
        $watchmen = Watchmen::where('is_delete', 0)->where('is_active', '1')->where('i_quit', '0')->where('is_dismissal', '0')->where('is_disconnected', '0')->orderBy('name', 'ASC')->get();
        foreach ($watchmen as &$w) {
            if (!$w->activated_in_assignment()) {
                array_push($list, $w);
                continue;
            }
        }
        return $list;
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messageValidation());
        if (!$validation->passes()) {
            return response()->json(['errors' => $validation->errors()], 400);
        }
        $vigilant = new Watchmen;
        $vigilant->name = $request->name;
        $vigilant->phone = $request->phone;
        $vigilant->dni = $request->dni;
        $vigilant->email = $request->email;
        $vigilant->address = $request->address;
        $vigilant->is_active = ($request->has('is_active') && ($request->is_active == 1 || $request->is_active == 'on')) ? '1' : 0;
        $vigilant->save();
        return $vigilant;
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), $this->rules($id), $this->messageValidation());
        if (!$validation->passes()) {
            return response()->json(['errors' => $validation->errors()], 400);
        }
        $vigilant = Watchmen::find($id);
        $vigilant->name = $request->name;
        $vigilant->phone = $request->phone;
        $vigilant->dni = $request->dni;
        $vigilant->email = $request->email;
        $vigilant->address = $request->address;
        if ($request->has('is_active') && ($request->is_active == 1 || $request->is_active == 'on')) {
            $vigilant->is_active = 1;
            $vigilant->i_quit = 0;
            $vigilant->is_dismissal = 0;
            $vigilant->is_disconnected = 0;
        } else {
            $vigilant->is_active = 1;
        }
        
        $vigilant->update();
        return $vigilant;
    }

    public function destroy(Request $request, $id)
    {
        $vigilant = Watchmen::find($id);
        $activated_in_assignment = $vigilant->activated_in_assignment();

        if (($vigilant->i_quit == 0 || $vigilant->is_dismissal == 0 || $vigilant->is_disconnected) && $activated_in_assignment) {
            return response()->json(['errors' => ['message' => 'El vigilante: '.$vigilant->name.', se encuentra activo en una programación, para eliminarlo debe remplazarlo en su programación ó crear un despido y/o renuncia']], 401);
        }

        if (($vigilant->i_quit == 0 || $vigilant->is_dismissal == 0 || $vigilant->is_disconnected) && count($vigilant->news()->get()) == 0 && $activated_in_assignment == false) {
            $vigilant->delete();
        } else {
            $vigilant->is_delete = 1;
            $vigilant->update();
        }        
        return ['sucess' => '1'];
    }

    public function rules($id = '')
    {
        $rules = [
            'dni' => ['required', Rule::unique('watchmen')->ignore($id)],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ];
        return $rules;
    }

    public function messageValidation()
    {
        $messages = [
            'name.required' => 'El nombre debe ser definido.',
            'dni.unique' => 'La cédula de identidad ya se encuentra registrada.',
            'phone.required' => 'El teléfono debe ser completado',
        ];
        return $messages;
    }
}
