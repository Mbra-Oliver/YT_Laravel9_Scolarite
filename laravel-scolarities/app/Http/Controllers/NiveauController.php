<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NiveauController extends Controller
{
    public function index()
    {
        return view('niveaux.list');
    }
}
