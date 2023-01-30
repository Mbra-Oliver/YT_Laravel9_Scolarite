<?php

namespace App\Http\Controllers;

use App\Models\Attribution;
use Illuminate\Http\Request;

class AttributionController extends Controller
{
    public function index()
    {
        return view('attributions.index');
    }

    public function create()
    {
        return view('attributions.create');
    }

    public function edit(Attribution $attribution)
    {
        return view('attributions.edit', compact('attribution'));
    }
}
