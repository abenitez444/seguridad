<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
use DB;
use App\Operations;
use App\Assignment;
use App\Clients;
use App\Watchmen;
use App\Shifts;

class OperationsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
        // $this->middleware('role:list_programming')->only(['assignment', 'getAllWithPagination']);
        // $this->middleware('role:create_programming')->only(['store']);
        // $this->middleware('role:edit_programming')->only(['update']);
        // $this->middleware('role:delete_programming')->only(['destroy']);
	}

    public function transfer(Request $request)
    {
        return view('admin.transfer');
    }

    public function reportsByType(Request $request, $type)
    {
        return view('admin.reports-operations');
    }

    public function getAllWithPaginationByType(Request $request, $type)
    {
        $per_page = 100;
        if ($request->has('per_page') && $request->per_page == 'all') {
            $per_page = Operations::where('type', $type)->count();
        } else {
            $per_page = $request->per_page;
        }
        $operations = Operations::where('type', $type)->paginate($per_page);
        foreach ($operations as &$op) {
            $op_origin = DB::table('operations_has_assignment_has_watchmen')->where('operations_id', $op->id)->where('is_origin', '1')->first();
            $op_destiny = DB::table('operations_has_assignment_has_watchmen')->where('operations_id', $op->id)->where('is_destiny', '1')->first();

            $assignment_origin = Assignment::find($op_origin->assignment_as_watchmen_assignment_id);
            $assignment_destiny = Assignment::find($op_destiny->assignment_as_watchmen_assignment_id);

            $assignment_watchmen_destiny = DB::table('assignment_as_watchmen')->where('id', $op_destiny->assignment_as_watchmen_id)->first();

            $op->assignment_id = $assignment_origin->id;
            $op->clients_id = $assignment_origin->clients_id;

            $op->client_transfer_selected = $assignment_destiny->clients_id;
            $op->assignment_transfer_id = $assignment_destiny->id;

            $op->clients_origin = Clients::find($assignment_origin->clients_id);
            $op->clients_destiny = Clients::find($assignment_destiny->clients_id);

            $op->watchmen = Watchmen::find($op_origin->assignment_as_watchmen_watchmen_id);
            $op->assignment_watchmen_origin = $assignment_origin->watchmen()->where('watchmen_id', $op->watchmen->id)->first();
            $op->assignment_watchmen_origin->shift = Shifts::find($op->assignment_watchmen_origin->pivot->shifts_id);
            $op->shift_selected = $op_destiny->assignment_as_watchmen_shifts_id;
            $op->start_vigilant = $assignment_watchmen_destiny->start;
            $op->start_date_vigilant = $assignment_watchmen_destiny->date_ini;
        }

        return $operations;
    }

    public function getReport(Request $request)
    {
        $all_operations = Operations::where('type', $request->type)->whereDate('created_at', '>=', $request->date_ini)->whereDate('created_at', '<=', $request->date_end)->get();
        $operations = [];
        foreach ($all_operations as &$op) {

            $op_origin = DB::table('operations_has_assignment_has_watchmen')->where('operations_id', $op->id)->where('is_origin', '1')->first();
            $op_destiny = DB::table('operations_has_assignment_has_watchmen')->where('operations_id', $op->id)->where('is_destiny', '1')->first();

            if ($request->watchmen != 'all' && $op_origin->assignment_as_watchmen_watchmen_id != $request->watchmen ) {
                continue;
            }
            //$op_origin->assignment_as_watchmen_watchmen_id

            $assignment_origin = Assignment::find($op_origin->assignment_as_watchmen_assignment_id);
            $assignment_destiny = Assignment::find($op_destiny->assignment_as_watchmen_assignment_id);

            $assignment_watchmen_destiny = DB::table('assignment_as_watchmen')->where('id', $op_destiny->assignment_as_watchmen_id)->first();

            $op->assignment_id = $assignment_origin->id;
            $op->clients_id = $assignment_origin->clients_id;

            $op->client_transfer_selected = $assignment_destiny->clients_id;
            $op->assignment_transfer_id = $assignment_destiny->id;

            $op->clients_origin = Clients::find($assignment_origin->clients_id);
            $op->clients_destiny = Clients::find($assignment_destiny->clients_id);

            $op->watchmen = Watchmen::find($op_origin->assignment_as_watchmen_watchmen_id);
            $op->assignment_watchmen_origin = $assignment_origin->watchmen()->where('watchmen_id', $op->watchmen->id)->first();
            $op->assignment_watchmen_origin->shift = Shifts::find($op->assignment_watchmen_origin->pivot->shifts_id);
            $op->assignment_watchmen_destiny = $assignment_destiny->watchmen()->where('watchmen_id', $op->watchmen->id)->first();
            $op->assignment_watchmen_destiny->shift = Shifts::find($op->assignment_watchmen_destiny->pivot->shifts_id);
            $op->shift_selected = $op_destiny->assignment_as_watchmen_shifts_id;
            $op->start_vigilant = $assignment_watchmen_destiny->start;
            $op->start_date_vigilant = $assignment_watchmen_destiny->date_ini;

            array_push($operations, $op);
        }
        return $operations;
    }

    public function printReport(Request $request)
    {
        $operations = $this->getReport($request);
        $report = $this->getReport($request);
        $title = 'Traslados de Vigilantes';
        $request->type = $title;
        $pdf = \PDF::loadView('admin.reports-operations-pdf', ['data' => $operations, 'request' => $request]);
        return $pdf->stream('Traslados '.$request->date_ini.' - '.$request->date_end.'.pdf');
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        $operation = new Operations;
        $operation->type = $request->type;
        $operation->save();

        DB::table('assignment_as_watchmen')
            ->where('id', $request->watchmen_selected['pivot']['id'])
            ->update(['is_active' => 0, 'date_end' => $request->start_date_vigilant]);

        DB::table('assignment_as_watchmen')->insert(
            [
                'watchmen_id' => $request->watchmen_id,
                'assignment_id' => $request->assignment_transfer_id,
                'start' => $request->start_vigilant,
                'date_ini' => $request->start_date_vigilant,
                'is_active' => 1,
                'replacement_of' => '0',
                'shifts_id' => $request->shift_selected,
            ]
        );

        DB::table('operations_has_assignment_has_watchmen')->insert(
            [
                'operations_id' => $operation->id,
                'assignment_as_watchmen_id' => $request->watchmen_selected['pivot']['id'],
                'assignment_as_watchmen_watchmen_id' => $request->watchmen_id,
                'assignment_as_watchmen_assignment_id' => $request->assignment_id,
                'assignment_as_watchmen_shifts_id' => $request->watchmen_selected['pivot']['shifts_id'],
                'is_origin' => 1,
                'is_destiny' => 0,
            ],
            [
                'operations_id' => $operation->id,
                'assignment_as_watchmen_id' => DB::table('assignment_as_watchmen')->orderBy('id', 'DESC')->first()->id,
                'assignment_as_watchmen_watchmen_id' => $request->watchmen_id,
                'assignment_as_watchmen_assignment_id' => $request->assignment_transfer_id,
                'assignment_as_watchmen_shifts_id' => $request->shift_selected,
                'is_origin' => 0,
                'is_destiny' => 1,
            ]
        );

        DB::table('operations_has_assignment_has_watchmen')->insert(
            [
                'operations_id' => $operation->id,
                'assignment_as_watchmen_id' => DB::table('assignment_as_watchmen')->orderBy('id', 'DESC')->first()->id,
                'assignment_as_watchmen_watchmen_id' => $request->watchmen_id,
                'assignment_as_watchmen_assignment_id' => $request->assignment_transfer_id,
                'assignment_as_watchmen_shifts_id' => $request->shift_selected,
                'is_origin' => 0,
                'is_destiny' => 1,
            ]
        );

        DB::commit();
        return ['success' => 1];
    }

    public function destroy(Request $request, $id)
    {
        // DB::beginTransaction();
        $operation = Operations::find($id);
        $op_origin = DB::table('operations_has_assignment_has_watchmen')->where('operations_id', $operation->id)->where('is_origin', '1')->first();
        $op_destiny = DB::table('operations_has_assignment_has_watchmen')->where('operations_id', $operation->id)->where('is_destiny', '1')->first();

        DB::table('operations_has_assignment_has_watchmen')->where('operations_id', $operation->id)->delete();

        DB::table('assignment_as_watchmen')
            ->where('id', $op_origin->assignment_as_watchmen_id)
            ->update(['is_active' => 1, 'date_end' => null]);

        DB::table('assignment_as_watchmen')
            ->where('id', $op_destiny->assignment_as_watchmen_id)
            ->delete();

        $operation->delete();        

        return $operation;
    }

}
