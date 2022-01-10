<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;


class agencyController extends Controller
{
    public function index(){
        return view('admin.agency');
    }
}
