<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LevelsController extends Controller
{
    public function index()
    {
        return view('niveaux.list');
    }

    public function create()
    {
        return view('niveaux.create');
    }
}
