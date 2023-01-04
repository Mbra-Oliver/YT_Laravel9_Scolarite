<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function create()
    {
        return view('settings.create');
    }
}
