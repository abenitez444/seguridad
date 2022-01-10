<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\News;
use App\Watchmen;
use App\Assignment;

class NewsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
        $this->middleware('role:list_news')->only(['index', 'getAllWithPagination']);
        $this->middleware('role:create_novelty')->only(['store']);
        $this->middleware('role:edit_novelty')->only(['update']);
        $this->middleware('role:delete_novelty')->only(['destroy']);
	}

    public function index()
    {
        /*$news = News::all();
        foreach ($news as $n) {
            if ($n->clients_id != null) {
                $n->assignment_clients_id = $n->clients_id;
                $n->assignment_id = DB::table('assignment')->where('clients_id', $n->clients_id)->first()->id;
            }
            $n->update();
        }*/
        return view('admin.news');
    }

    public function shiftChange()
    {
        return view('admin.shift-change');
    }

    public function getAllWithPagination(Request $request)
    {
        $per_page = 100;
        if ($request->has('per_page') && $request->per_page == 'all') {
            // $per_page = News::where('type', '<>', 'Cambio de Turno')->count();
            $per_page = News::count();
        } else {
            $per_page = $request->per_page;
        }
        // $news = News::where('type', '<>', 'Cambio de Turno')->paginate($per_page);
        $news = News::paginate($per_page);
        foreach ($news as &$new) {
            $new->assignment = $new->assignment()->first();
            if ($new->clients_id != null) {
                $new->client = $new->client()->first();
            }
            
            if ($new->clients_id_change != null) {
                $new->client_change = $new->client_change()->first();
            }

            $watchmen = $new->watchmen()->get();
            $new->count_watchmen = count($watchmen);
            foreach ($watchmen as $w) {
                if ($w->pivot->is_principal) {
                    $new->vigilant_principal = $w;
                    continue;
                }

                if (!$w->pivot->is_principal) {
                    $new->vigilant_change = $w;
                    continue;
                }
            }
        }
        return $news;
    }

    public function getAllWithPaginationByType(Request $request)
    {
        $per_page = 100;
        if ($request->has('per_page') && $request->per_page == 'all') {
            $per_page = News::where('type', $request->type)->count();
        } else {
            $per_page = $request->per_page;
        }
        $news = News::where('type', $request->type)->paginate($per_page);
        foreach ($news as &$new) {
            $new->assignment = $new->assignment()->first();
            $new->novelty = News::find($new->news_id);

            if ($new->novelty != null) {
                $new->client = DB::table('clients')->where('id', $new->novelty->assignment_clients_id)->first();
            } else {
                $new->client = $new->client()->first();
            }

            if ($new->clients_id_change != null) {
                $new->client_change = $new->client_change()->first();
            }

            $watchmen = $new->watchmen()->get();
            foreach ($watchmen as $w) {
                if ($w->pivot->is_principal) {
                    $new->vigilant_principal = $w;
                    continue;
                }

                if (!$w->pivot->is_principal) {
                    $new->vigilant_change = $w;
                    continue;
                }
            }
        }
        return $news;
    }

    public function reports()
    {
        return view('admin.reportNews');
    }

    public function reportsByType(Request $request, $type)
    {
        return view('admin.reportNewsByType', ['type' => $type]);
    }

    public function getReport(Request $request)
    {
        $report = News::select('news.*', 'watchmen_has_news.watchmen_id', 'watchmen_has_news.news_id', 'watchmen_has_news.is_principal')->join('watchmen_has_news', 'news.id', '=', 'watchmen_has_news.news_id')->where('watchmen_has_news.is_principal', 1)->orderBy('news.date_ini', 'ASC')->orderBy('news.id', 'ASC');

        if ($request->type != 'all') {
            $report = $report->where('news.type', $request->type);
        } else {
            $report = $report->where('news.type', '<>', $request->type);
        }

        if ($request->has('watchmen') && $request->watchmen != 'all') {
            $report = $report->where('watchmen_has_news.watchmen_id', $request->watchmen)->where('watchmen_has_news.is_principal', '1');
        }

        $report = $report->where('date_ini', '>=', $request->date_ini)->where('date_ini', '<=', $request->date_end);

        $news = $report->get();

        $news_selected = [];
        
        foreach ($news as &$new) {

            if ($new->type != 'Cambio de Turno' && $new->type != 'Desvinculación') {
                if (!($new->date_end <= $request->date_end && $new->date_end >= $request->date_ini)) {
                    continue;
                }
            }


            $new->assignment = $new->assignment()->first();
            if ($new->clients_id != null) {
                $new->client = $new->client()->first();
            } else if ($new->clients_id == null) {
                $new->client = $new->client()->where('id', $new->assignment_clients_id)->first();
            }
            
            if ($new->clients_id_change != null) {
                $new->client_change = $new->client_change()->first();
            }

            $watchmen = $new->watchmen()->get();
            $new->count_watchmen = count($watchmen);
            if ($new->count_watchmen > 0) {
                foreach ($watchmen as $w) {
                    if ($w->pivot->is_principal) {
                        $new->vigilant_principal = $w;
                        continue;
                    }

                    if (!$w->pivot->is_principal) {
                        $new->vigilant_change = $w;
                        continue;
                    }
                }
            } else {
                if ($new->watchmen_id != null && $new->is_principal == 1) {
                    $new->vigilant_principal = Watchmen::find($new->watchmen_id);
                }
            }

            array_push($news_selected, $new);
            
        }
        return $news_selected;
    }

    public function printReport(Request $request)
    {
        $report = $this->getReport($request);
        // dd($report);
        $pdf = \PDF::loadView('admin.reportsNews-pdf', ['data' => $report, 'request' => $request]);
        return $pdf->stream('Novedades '. $request->type .' '.$request->date_ini.' - '.$request->date_end.'.pdf');
    }

    public function store(Request $request)
    {
        // DB::beginTransaction();
        $w_has_news = DB::table('watchmen_has_news')->where('watchmen_id', $request->vigilant_change_id)->first();
        if ($w_has_news != null && $request->type != 'Desvinculación') {
            $watchmen = Watchmen::find($request->vigilant_change_id);

            $novelty = News::where('id', $w_has_news->news_id)->where('is_active', '1')->first();

            if ($novelty != null) {
                if ($request->type != 'Cambio de Turno') {
                    if (!(($request->date_ini < $novelty->date_ini && $request->date_end < $novelty->date_ini) || ($request->date_ini > $novelty->date_end && $request->date_end > $novelty->date_end))) {
                        return response()->json(['errors' => ['message' => 'El vigilante: '.$watchmen->name.', se encuentra activo en una novedad en el rango de fecha seleccionada.']], 401);
                    }
                } else {
                    if (!(($request->date_ini < $novelty->date_ini) || ($request->date_ini > $novelty->date_end))) {
                        return response()->json(['errors' => ['message' => 'El vigilante: '.$watchmen->name.', se encuentra activo en una novedad en el rango de fecha seleccionada.']], 401);
                    }                
                }
                                
            }            
        }

        if ($request->type == 'Desvinculación') {
            $vigilant_principal = Watchmen::find($request->vigilant_principal_id);
            $replacement = DB::table('assignment_as_watchmen')
                ->where('watchmen_id', $vigilant_principal->id)
                ->where('is_active', 1)
                // ->where('date_end', null)
                // ->first();
                ->get();
            foreach ($replacement as $rep) {
                if ($rep->date_ini > $request->date_ini) {
                    return response()->json(['errors' => ['message' => 'Para descincular a un vigilante debe marcar una fecha mayor a la de inicio del vigilante en todas sus programaciones activo.']], 401);
                }
            }
                
        }

        $novelty = new News;
        // $novelty->clients_id = $request->clients_id;
        if ($request->type == 'Cambio de Turno' || $request->type == 'Desvinculación') {
            if (Assignment::find($request->assignment_id) == null) {
                $novelty->news_id = $request->assignment_id;
            } else {
                $novelty->assignment_id = $request->assignment_id;
                $novelty->assignment_clients_id = Assignment::find($request->assignment_id)->clients_id;
            }
        } else {
            $novelty->assignment_id = $request->assignment_id;
            $novelty->assignment_clients_id = Assignment::find($request->assignment_id)->clients_id;
        }        
        $novelty->type = $request->type;
        $novelty->date_ini = $request->date_ini;
        $novelty->date_end = $request->date_end;
        $novelty->details = $request->details;
        $novelty->is_active = ($request->has('is_active')) ? 1 : 0;
        if ($request->has('has_doc')) {
            $novelty->has_doc = 1;
            $image_name = 'novelty-'.strtotime('now').'.'.$request->image->getClientOriginalExtension();
            $novelty->ext_doc = $request->image->getClientOriginalExtension();
            $path = $request->image->storeAs('novelty', $image_name, 'public');
            $novelty->url_doc = $path;
        } else {
            $novelty->has_doc = 0;
        }

        $novelty->shifts_double = $request->shifts_double;
        $novelty->shifts_new = $request->shifts_new;
        $novelty->shifts_old = $request->shifts_old;
        $novelty->clients_id_change = $request->clients_id_change;

        $novelty->save();

        DB::table('watchmen_has_news')->insert(
            ['watchmen_id' => $request->vigilant_principal_id, 'is_principal' => 1, 'news_id' => $novelty->id]
        );

        if ($novelty->type != 'Cambio de Turno' && $request->vigilant_change_id != '') {
            DB::table('watchmen_has_news')->insert(
                ['watchmen_id' => $request->vigilant_change_id, 'is_principal' => 0, 'news_id' => $novelty->id]
            );
        }

        if ($novelty->type == 'Desvinculación') {
            $vigilant_principal = Watchmen::find($request->vigilant_principal_id);
            $vigilant_principal->is_active = 0;
            $vigilant_principal->is_disconnected = 1;
            $vigilant_principal->update();

            //Colocar fin a la programacion anterior del vigilante (Despedido o Renunciado)
            $replacement = DB::table('assignment_as_watchmen')
                ->where('watchmen_id', $vigilant_principal->id)
                ->where('is_active', 1)
                // ->where('date_end', null)
                // ->first();
                ->get();

            DB::table('assignment_as_watchmen')
                ->where('watchmen_id', $vigilant_principal->id)
                ->where('is_active', 1)
                // ->where('date_end', null)
                ->update(['is_active' => 0, 'date_end' => $novelty->date_ini]);

            // Se agrega a la programación anterior el remplazo seleccionado
            foreach ($replacement as $replace) {
                DB::table('assignment_as_watchmen')->insert(
                    /*[
                        'watchmen_id' => $request->vigilant_change_id,
                        'assignment_id' => $replace->assignment_id,
                        'start' => $replace->start,
                        'date_ini' => $novelty->date,
                        'is_active' => 1,
                        'replacement_of' => $replace->id,
                    ]*/
                    [
                        'watchmen_id' => $request->vigilant_change_id,
                        'assignment_id' => $replace->assignment_id,
                        'start' => $replace->start,
                        'date_ini' => $novelty->date_ini,
                        'is_active' => 1,
                        'replacement_of' => $replace->id,
                        'shifts_id' => $replace->shifts_id,
                    ]
                );
            }
        }
        
        return $novelty;
    }

    public function update(Request $request, $id)
    {
        $novelty = News::find($id);

        if ($request->vigilant_change_id_old != $request->vigilant_change_id && $request->type != 'Cambio de Turno') {
            $w_has_news = DB::table('watchmen_has_news')->where('watchmen_id', $request->vigilant_change_id)->first();
            if ($w_has_news != null) {
                $watchmen = Watchmen::find($request->vigilant_change_id);

                $novelty = News::where('id', $w_has_news->news_id)->where('is_active', '1')->first();

                if ($novelty != null) {
                    if ($request->type != 'Cambio de Turno') {
                        if (!(($request->date_ini < $novelty->date_ini && $request->date_end < $novelty->date_ini) || ($request->date_ini > $novelty->date_end && $request->date_end > $novelty->date_end))) {
                            return response()->json(['errors' => ['message' => 'El vigilante: '.$watchmen->name.', se encuentra activo en una novedad en el rango de fecha seleccionada.']], 401);
                        }
                    } else {
                        if (!(($request->date_ini < $novelty->date_ini) || ($request->date_ini > $novelty->date_end))) {
                            return response()->json(['errors' => ['message' => 'El vigilante: '.$watchmen->name.', se encuentra activo en una novedad en el rango de fecha seleccionada.']], 401);
                        }                
                    }
                                    
                }             
            }
        }       
        
        
        // $novelty->clients_id = $request->clients_id;
        if ($request->type == 'Cambio de Turno') {
            if (Assignment::find($request->assignment_id) == null) {
                $novelty->news_id = $request->assignment_id;
            } else {
                $novelty->assignment_id = $request->assignment_id;
                $novelty->assignment_clients_id = Assignment::find($request->assignment_id)->clients_id;
            }
        } else {
            $novelty->assignment_id = $request->assignment_id;
            $novelty->assignment_clients_id = Assignment::find($request->assignment_id)->clients_id;
        }
        $novelty->type = $request->type;
        $novelty->date_ini = $request->date_ini;
        $novelty->date_end = $request->date_end;
        $novelty->details = $request->details;
        $novelty->is_active = ($request->has('is_active')) ? 1 : 0;
        if ($request->has('has_doc') && $request->hasFile('image')) {
            Storage::disk('public')->delete($novelty->url_doc);
            $novelty->has_doc = 1;
            $image_name = 'novelty-'.strtotime('now').'.'.$request->image->getClientOriginalExtension();
            $novelty->ext_doc = $request->image->getClientOriginalExtension();
            $path = $request->image->storeAs('novelty', $image_name, 'public');
            $novelty->url_doc = $path;
        } else if($request->has('has_doc') && !$request->hasFile('image')){
            $novelty->has_doc = 1;
        } else {
            $novelty->has_doc = 0;
            Storage::disk('public')->delete($novelty->url_doc);
            $novelty->url_doc = null;
            $novelty->ext_doc = null;
        }

        $novelty->shifts_double = $request->shifts_double;
        $novelty->shifts_new = $request->shifts_new;
        $novelty->shifts_old = $request->shifts_old;
        $novelty->clients_id_change = $request->clients_id_change;
        
        $novelty->update();

        DB::table('watchmen_has_news')->where('news_id', $novelty->id)->delete();

        DB::table('watchmen_has_news')->insert(
            ['watchmen_id' => $request->vigilant_principal_id, 'is_principal' => 1, 'news_id' => $novelty->id]
        );

        if ($novelty->type != 'Cambio de Turno' && $request->vigilant_change_id != '') {
            DB::table('watchmen_has_news')->insert(
                ['watchmen_id' => $request->vigilant_change_id, 'is_principal' => 0, 'news_id' => $novelty->id]
            );
        }
        return $novelty;
    }

    public function destroy(Request $request, $id)
    {
        // DB::beginTransaction();
        $novelty = News::find($id);
        Storage::disk('public')->delete($novelty->url_doc);
        if ($novelty->type == 'Desvinculación') {
            $watchmen = $novelty->watchmen()->get();
            foreach ($watchmen as $w) {
                if ($w->pivot->is_principal) {
                    $vigilant_principal = $w;
                    continue;
                } else {
                    $vigilant_change = $w;
                    continue;
                }
            }

            $vigilant_principal->is_active = 1;
            $vigilant_principal->is_disconnected = 0;
            $vigilant_principal->update();

            $vigilant_change->is_active = 1;
            $vigilant_change->is_disconnected = 0;
            $vigilant_change->update();

            $replacement = DB::table('assignment_as_watchmen')
                ->where('watchmen_id', $vigilant_change->id)
                ->where('is_active', 1)
                ->where('date_ini', $novelty->date_ini)
                ->get();

            foreach ($replacement as $replace) {
                if ($replace->replacement_of == 0) {
                    continue;
                }

                DB::table('assignment_as_watchmen')
                ->where('id', $replace->replacement_of)
                ->where('watchmen_id', $vigilant_principal->id)
                ->where('is_active', 0)
                ->where('date_end', $replace->date_ini)
                ->update(['is_active' => 1, 'date_end' => null]);

                DB::table('assignment_as_watchmen')->where('id', $replace->id)->delete();
            }
        }

        DB::table('watchmen_has_news')->where('news_id', $novelty->id)->delete();
        $novelty->delete();
        return ['sucess' => '1'];
    }
}
