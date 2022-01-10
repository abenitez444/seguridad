<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
use DB;
use App\Assignment;
use App\Watchmen;
use App\Shifts;
use App\News;

class AssignmentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
        $this->middleware('role:list_programming')->only(['assignment', 'getAllWithPagination']);
        $this->middleware('role:create_programming')->only(['store']);
        $this->middleware('role:edit_programming')->only(['update']);
        $this->middleware('role:delete_programming')->only(['destroy']);
	}

    public function assignment(Request $request)
    {
        /*$assignment = Assignment::all();
        foreach ($assignment as $a) {
            $date_ini = $a->date_ini;
            $date_ini = explode('-', $date_ini);
            $date_end = ($date_ini[0]+1).'-'.$date_ini[1].'-'.$date_ini[2];
            $a->date_end = $date_end;
            $a->update();
        }*/
        return view('admin.assignment');
    }

    public function assignment_form()
    {
        if (auth()->user()->has_role('create_programming') || auth()->user()->has_role('edit_programming') || auth()->user()->is_superadmin) {
            return view('admin.assignment-create');
        }
        return redirect()->back()->with('errors', 'No puede acceder a la sección ya que no posee los permisos necesario');
        
    }

    public function getAllWithPagination(Request $request)
    {
        $per_page = 100;
        if ($request->has('per_page') && $request->per_page == 'all') {
            $per_page = Assignment::all()->count();
        } else {
            $per_page = $request->per_page;
        }
        $assignment = Assignment::paginate($per_page);
        foreach ($assignment as &$a) {
            $a->client = $a->client()->first();
            $a->client->shift = $a->client->shift()->first();
            if ($a->client->type_of_programming == 2) {
                $selected = [];
                $shifts_selected = DB::table('client_has_shifts')->where('clients_id', $a->client->id)->get();
                foreach ($shifts_selected as $s) {
                    array_push($selected, DB::table('shifts')->where('id', $s->shifts_id)->first());
                }
                $a->client->shifts_selected = $selected;
            }
            $a->watchmen = $a->watchmen()->get();
            $a->num_watchmen = count($a->watchmen_activated()->get());
            foreach ($a->watchmen as &$w) {
                if (!$w->activated_in_assignment()) {
                    $w->has_assignment = 0;
                } else {
                    $w->has_assignment = 1;
                }
                $w->shift = Shifts::find($w->pivot->shifts_id);
                /*$w->assignment = $w->assignment()->where('assignment_id', $a->id)->get();
                foreach ($w->assignment as $assig) {
                    $assig->shift = Shifts::find($assig->pivot->shifts_id);
                }*/
            }
            $a->novelty = $a->novelty()->get();
            foreach ($a->novelty as $novelty) {
                $watchmen = $novelty->watchmen()->get();
                if ($novelty->type == 'Cambio de Turno') {
                    $client_change = DB::table('clients')->where('id', $novelty->clients_id_change)->first();
                    $novelty->clients_change = $client_change;
                }
                foreach ($watchmen as $w) {
                    $w->shift = DB::table('shifts')->where('id', $w->pivot->shifts_id)->first();
                    if ($w->pivot->is_principal) {
                        $novelty->vigilant_principal = $w;
                        continue;
                    }

                    if (!$w->pivot->is_principal) {
                        $novelty->vigilant_change = $w;
                        continue;
                    }
                }
            }
            /*$a->client->news = $a->client->news()->get();
            foreach ($a->client->news as $new) {
                $watchmen = $new->watchmen()->get();
                if ($new->type == 'Cambio de Turno') {
                    $client_change = DB::table('clients')->where('id', $new->clients_id_change)->first();
                    $new->clients_change = $client_change;
                }
                foreach ($watchmen as $w) {
                    $w->shift = DB::table('shifts')->where('id', $w->pivot->shifts_id)->first();
                    if ($w->pivot->is_principal) {
                        $new->vigilant_principal = $w;
                        continue;
                    }

                    if (!$w->pivot->is_principal) {
                        $new->vigilant_change = $w;
                        continue;
                    }
                }
            }*/
            
        }
        return $assignment;
    }

    public function getListWatchmenByClient(Request $request, $id_assignment, $id_cleint)
    {
        // $assignment_id = DB::table('assignment_as_watchmen')->where('watchmen_id', $id_cleint)->first()->assignment_id;
        $assignment = Assignment::where('clients_id',$id_cleint)->where('id', $id_assignment)->first();
        $list = $assignment->watchmen()->get();
        $list_watchmen = [];
        $list_watchmen_deactivated = [];
        foreach ($list as &$w) {
            $w->start = $w->pivot->start;
            $w->start_date = $w->pivot->date_ini;
            $w->shift = DB::table('shifts')->where('id', $w->pivot->shifts_id)->first();
            if ($w->pivot->is_active == 1) {
                $w->activated = 1;
                array_push($list_watchmen, $w);
            } else {
                $w->activated = 0;
                array_push($list_watchmen_deactivated, $w);
            }
        }
        return ['activated' => $list_watchmen, 'deactivated' => $list_watchmen_deactivated, 'date_ini' => $assignment->date_ini, 'date_end' => $assignment->date_end];
    }

    public function store(Request $request)
    {
        // return $request->all();
        // DB::beginTransaction();
        foreach ($request->list_watchmen as $w) {
            $date_ini_array = explode('-', $w['start_date']);
            $date_end = $date_ini_array[0]+1 . '-' . $date_ini_array[1] . '-' . $date_ini_array[2];
            $w_has_news = DB::table('watchmen_has_news')->where('watchmen_id', $w['id'])->first();
            if ($w_has_news != null) {
                $watchmen = Watchmen::find($w['id']);

                $novelty = News::where('id', $w_has_news->news_id)->where('is_active', '1')->whereBetween('date_ini', [$w['start_date'], $date_end])->first();

                if ($novelty == null) {
                    continue;
                }
                return response()->json(['errors' => ['message' => 'El vigilante: '.$watchmen->name.', se encuentra activo en una novedad en el rango de fecha de la programación.']], 401);
            }
        }

        // return $request->all();

        $assignment = new Assignment;
        $assignment->clients_id = $request->clients_id;
        $assignment->date_ini = $request->date_ini;
        $assignment->date_end = $request->date_end;
        $assignment->save();

        foreach ($request->list_watchmen as $w) {
            DB::table('assignment_as_watchmen')->insert(
                [
                    'watchmen_id' => $w['id'],
                    'assignment_id' => $assignment->id,
                    'start' => $w['start'],
                    'date_ini' => $w['start_date'],
                    'is_active' => 1,
                    'replacement_of' => 0,
                    'shifts_id' => $w['shift']['id'],
                ]
            );
        }
        return ['sucess' => '1'];
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        DB::beginTransaction();
        $assignment = Assignment::find($id);
        $assignment->date_ini = $request->date_ini;
        $assignment->date_end = $request->date_end;
        $assignment->update();
        foreach ($request->list_watchmen as $w) {
            $date_ini_array = explode('-', $w['start_date']);
            $date_end = $date_ini_array[0]+1 . '-' . $date_ini_array[1] . '-' . $date_ini_array[2];
            if (isset($w['activated']) && $w['activated'] == 1) {
                continue;
            }
            $w_has_news = DB::table('watchmen_has_news')->where('watchmen_id', $w['id'])->first();
            if ($w_has_news != null) {
                $watchmen = Watchmen::find($w['id']);

                $novelty = News::where('id', $w_has_news->news_id)->where('is_active', '1')->whereBetween('date_ini', [$w['start_date'], $date_end])->first();

                if ($novelty == null) {
                    continue;
                }
                return response()->json(['errors' => ['message' => 'El vigilante: '.$watchmen->name.', se encuentra activo en una novedad en el rango de fecha de la programación.']], 401);
            }
        }

        foreach ($request->list_watchmen as $w) {
            if (isset($w['activated']) && $w['activated'] == 0) {
                $replacement = DB::table('assignment_as_watchmen')
                ->where('watchmen_id', $w['replace_watchmen'])
                ->where('id', $w['replace_watchmen_id'])
                ->where('assignment_id', $assignment->id)
                ->orderBy('id', 'DESC')
                ->first();

                if ($w['start_date'] <= $replacement->date_ini) {
                    return response()->json(['errors' => ['message' => 'El vigilante: '.$w['name'].', seleccionado como relevó debe tener como fecha de inico, superior al vigilante que relevará.']], 401);
                }

                DB::table('assignment_as_watchmen')
                ->where('id', $w['replace_watchmen_id'])
                ->where('watchmen_id', $w['replace_watchmen'])
                ->where('assignment_id', $assignment->id)
                ->update(['is_active' => 0, 'date_end' => $w['start_date']]);

                DB::table('assignment_as_watchmen')->insert(
                    [
                        'watchmen_id' => $w['id'],
                        'assignment_id' => $assignment->id,
                        'start' => $w['start'],
                        'date_ini' => $w['start_date'],
                        'is_active' => 1,
                        'replacement_of' => $replacement->id,
                        'shifts_id' => $w['shift']['id'],
                    ]
                );
            } else if (!isset($w['activated'])) {
                DB::table('assignment_as_watchmen')->insert(
                    [
                        'watchmen_id' => $w['id'],
                        'assignment_id' => $assignment->id,
                        'start' => $w['start'],
                        'date_ini' => $w['start_date'],
                        'is_active' => 1,
                        'replacement_of' => 0,
                        'shifts_id' => $w['shift']['id'],
                    ]
                );
            }
        }

        foreach ($request->list_watchmen_deactivated as $w) {
            DB::table('assignment_as_watchmen')
                ->where('id', $w['pivot']['id'])
                ->where('watchmen_id', $w['id'])
                ->where('assignment_id', $assignment->id)
                ->update(['is_active' => 0, 'date_end' => $w['pivot']['date_end']]);
        }
        $assignment->update();
        DB::commit();
        return ['sucess' => '1'];
    }

    public function destroy(Request $request, $id)
    {
        $assignment = Assignment::find($id);
        DB::table('assignment_as_watchmen')->where('assignment_id', $id)->delete();
        $assignment->delete();
        return ['success' => '1'];
    }
}
