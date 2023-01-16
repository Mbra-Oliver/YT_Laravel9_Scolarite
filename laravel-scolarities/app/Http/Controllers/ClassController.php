<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        return view('classes.list');
    }

    public function create()
    {
        return view('classes.create');
    }

    public function edit(Classe $classe)
    {
        return view('classes.edit', compact('classe'));
    }
}
