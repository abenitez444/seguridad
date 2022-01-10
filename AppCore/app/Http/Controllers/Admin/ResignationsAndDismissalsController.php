<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\ResignationsAndDismissals;
use App\Watchmen;

class ResignationsAndDismissalsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
        $this->middleware('role:list_dismissal')->only(['index', 'getAllWithPagination']);
        $this->middleware('role:create_dismissal')->only(['store']);
        $this->middleware('role:delete_dismissal')->only(['destroy']);
	}

    public function index()
    {
        return view('admin.resignationsAndDismissals');
    }

    public function getAllWithPagination(Request $request)
    {
        $per_page = 100;
        if ($request->has('per_page') && $request->per_page == 'all') {
            $per_page = ResignationsAndDismissals::all()->count();
        } else {
            $per_page = $request->per_page;
        }
        $news = ResignationsAndDismissals::paginate($per_page);
        foreach ($news as &$novelty) {
            $watchmen = $novelty->watchmen()->get();
            $novelty->vigilant_principal = null;
            $novelty->vigilant_change = null;
            foreach ($watchmen as $w) {
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
        return $news;
    }

    public function reports()
    {
        return view('admin.reportsResignations');
    }

    public function getReport(Request $request)
    {
        $report = ResignationsAndDismissals::where('type', $request->type)->where('date', '>=', $request->date_ini)->where('date', '<=', $request->date_end)->get();
        foreach ($report as &$novelty) {
            $watchmen = $novelty->watchmen()->get();
            // $novelty->client = $novelty->client()->first();
            $novelty->vigilant_principal = null;
            $novelty->vigilant_change = null;
            foreach ($watchmen as $w) {
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
        return $report;
    }

    public function printReport(Request $request)
    {
        $report = $this->getReport($request);
        $pdf = \PDF::loadView('admin.reportsResignations-pdf', ['data' => $report, 'request' => $request]);
        return $pdf->stream('Despidos y Renuncias '.$request->date_ini.' - '.$request->date_end.'.pdf');
        // return dd($report);
    }

    public function store(Request $request)
    {
        // return $request->all();
        DB::beginTransaction();
        $novelty = new ResignationsAndDismissals;
        $novelty->type = $request->type;
        $novelty->date = $request->date;
        $novelty->details = $request->details;
        if ($request->has('has_doc')) {
            $novelty->has_doc = 1;
            $image_name = 'novelty-'.strtotime('now').'.'.$request->image->getClientOriginalExtension();
            $novelty->ext_doc = $request->image->getClientOriginalExtension();
            $path = $request->image->storeAs('novelty', $image_name, 'public');
            $novelty->url_doc = $path;
        } else {
            $novelty->has_doc = 0;
        }
        $novelty->save();

        DB::table('watchmen_has_dismissals')->insert(
            ['watchmen_id' => $request->vigilant_id, 'is_principal' => 1, 'resignations_and_dismissals_id' => $novelty->id]
        );

        $vigilant_principal = Watchmen::find($request->vigilant_id);
        $vigilant_principal->is_active = 0;
        if ($novelty->type == 'Despido') {
            $vigilant_principal->is_dismissal = 1;
            $vigilant_principal->i_quit = 0;
        } else {
            $vigilant_principal->is_dismissal = 0;
            $vigilant_principal->i_quit = 1;
        }
        $vigilant_principal->update();

        if ($request->has('vigilant_change_id')) {
            DB::table('watchmen_has_dismissals')->insert(
                ['watchmen_id' => $request->vigilant_change_id, 'is_principal' => 0, 'resignations_and_dismissals_id' => $novelty->id]
            );

            //Colocarl fin a la programacion anterior del vigilante (Despedido o Renunciado)
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
                ->update(['is_active' => 0, 'date_end' => $novelty->date]);

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
                        'date_ini' => $novelty->date,
                        'is_active' => 1,
                        'replacement_of' => $replace->id,
                        'shifts_id' => $replace->shifts_id,
                    ]
                );
            }
        }
        DB::commit();
        
        return $novelty;
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        $novelty = ResignationsAndDismissals::find($id);
        Storage::disk('public')->delete($novelty->url_doc);
        $watchmen = $novelty->watchmen()->get();
        if (count($watchmen) > 1) {
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
            $vigilant_principal->i_quit = 0;
            $vigilant_principal->is_dismissal = 0;
            $vigilant_principal->update();

            $vigilant_change->is_active = 1;
            $vigilant_change->i_quit = 0;
            $vigilant_change->is_dismissal = 0;
            $vigilant_change->update();

            
            $replacement = DB::table('assignment_as_watchmen')
                ->where('watchmen_id', $vigilant_change->id)
                ->where('is_active', 1)
                ->where('date_ini', $novelty->date)
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
            

            /*DB::table('assignment_as_watchmen')
                ->where('watchmen_id', $vigilant_change->id)
                ->where('is_active', 1)
                ->where('date_end', null)
                ->delete();*/

        } else {
            $vigilant_principal = $watchmen[0];
            $vigilant_principal->is_active = 1;
            $vigilant_principal->i_quit = 0;
            $vigilant_principal->is_dismissal = 0;
            $vigilant_principal->update();
        }

        DB::table('watchmen_has_dismissals')->where('resignations_and_dismissals_id', $novelty->id)->delete();
        $novelty->delete();
        DB::commit();
        return ['sucess' => '1'];
    }
}
