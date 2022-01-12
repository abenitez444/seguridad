<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


class agencyController extends Controller
{
    public function index(){
        return view('admin.agency');
    }

    public function getCountries(){
        dd("Llegamos");
    }
}
