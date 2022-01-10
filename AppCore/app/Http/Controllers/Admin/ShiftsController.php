<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Shifts;

class ShiftsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
        $this->middleware('role:list_shifts')->only(['index', 'getAllWithPagination']);
        $this->middleware('role:create_shifts')->only(['store']);
        $this->middleware('role:edit_shifts')->only(['update']);
        $this->middleware('role:delete_shifts')->only(['destroy']);
	}

	public function index()
	{
		return view('admin.shifts');
	}

    public function getAllActivated(Request $request)
    {
        return Shifts::where('is_active', '1')->get();
    }

    public function getAllWithPagination(Request $request)
    {
    	$per_page = 100;
        if ($request->has('per_page') && $request->per_page == 'all') {
            $per_page = Shifts::all()->count();
        } else {
            $per_page = $request->per_page;
        }
        $shifts = Shifts::paginate($per_page);
        return $shifts;
    }

    public function store(Request $request)
    {
    	$shift = new Shifts;
    	$shift->name = $request->name;
    	$shift->cant_watchmen = $request->cant_watchmen;
    	$shift->is_active = ($request->has('is_active') && ($request->is_active == 1 || $request->is_active == 'on')) ? '1' : 0;

    	$cant_turn = [];
    	$turn = [];
    	$total = 0;

    	if (isset($request->d) && $request->d > 0) {
    		array_push($turn, 'D');
    		array_push($cant_turn, 'D='.$request->d);
    		$total = $total + $request->d;
    	}
    	if (isset($request->n) && $request->n > 0) {
    		array_push($turn, 'N');
    		array_push($cant_turn, 'N='.$request->n);
    		$total = $total + $request->n;
    	}
    	if (isset($request->x) && $request->x > 0) {
    		array_push($turn, 'X');
    		array_push($cant_turn, 'X='.$request->x);
    		$total = $total + $request->x;
    	}

    	if (count($turn) > 0) {
    		$shift->turn = implode(',', $turn);
    	} else {
    		$shift->turn = '';
    	}
    	if (count($cant_turn) > 0) {
    		$shift->cant_turn = implode(',', $cant_turn);
    	} else {
    		$shift->cant_turn = '';
    	}
    	$shift->cant_total = $total;
    	$shift->save();
    	return ['success' => '1', 'shift' => $shift];
    }

    public function update(Request $request, $id)
    {
    	$shift = Shifts::find($id);
    	$shift->name = $request->name;
    	$shift->cant_watchmen = $request->cant_watchmen;
    	$shift->is_active = ($request->has('is_active') && ($request->is_active == 1 || $request->is_active == 'on')) ? '1' : 0;

    	$cant_turn = [];
    	$turn = [];
    	$total = 0;

    	if (isset($request->d) && $request->d > 0) {
    		array_push($turn, 'D');
    		array_push($cant_turn, 'D='.$request->d);
    		$total = $total + $request->d;
    	}
    	if (isset($request->n) && $request->n > 0) {
    		array_push($turn, 'N');
    		array_push($cant_turn, 'N='.$request->n);
    		$total = $total + $request->n;
    	}
    	if (isset($request->x) && $request->x > 0) {
    		array_push($turn, 'X');
    		array_push($cant_turn, 'X='.$request->x);
    		$total = $total + $request->x;
    	}

    	if (count($turn) > 0) {
    		$shift->turn = implode(',', $turn);
    	} else {
    		$shift->turn = '';
    	}
    	if (count($cant_turn) > 0) {
    		$shift->cant_turn = implode(',', $cant_turn);
    	} else {
    		$shift->cant_turn = '';
    	}
    	$shift->cant_total = $total;
    	$shift->update();
    	return ['success' => '1', 'shift' => $shift];
    }

    public function destroy($id)
    {
    	DB::beginTransaction();
    	try {
    		$shift = Shifts::find($id);
    		$shift->delete();
    		DB::commit();
    		return response()->json(['success' => '1']);
    	} catch (\Exception $e) {
    		DB::rollback();
    		return response()->json(['errors' => ['message' => $e->getMessage(), 'line' => $e->gerLine()]]);
    	}
    }
}
