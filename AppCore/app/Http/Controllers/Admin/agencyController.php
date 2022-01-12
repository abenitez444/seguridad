<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use Inertia\Inertia;


class agencyController extends Controller
{
    public function index(){
        return view('admin.agency');
    }

    public function getCountries(){
        try {
            $country = Country::all();

            return response()->json([
                'country' => $country,
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
