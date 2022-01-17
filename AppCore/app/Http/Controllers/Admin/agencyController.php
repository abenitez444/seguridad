<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\State;
use Inertia\Inertia;


class agencyController extends Controller
{
    public function index(){
        return view('admin.agency');
    }

    public function getCountries(){
        try {
            $country = Country::all();
            //$state = State::all();


            return response()->json([
                'country' => $country,
                //'state' => $state,
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getStates($code)
    {
        try {
            $states = State::where('pais_id', $code)->get();
            return response()->json([
                "states" => $states
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function store(Request $request){
       dd($request);
    }
}
