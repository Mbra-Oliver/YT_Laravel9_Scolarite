<?php

namespace App\Http\Controllers;

use App\Models\SchoolFees;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function index()
    {
        return view('frais.list');
    }

    public function create()
    {
        return view('frais.create');
    }

    public function edit(SchoolFees $fee)
    {
        return view('frais.edit', compact('fee'));
    }
}
