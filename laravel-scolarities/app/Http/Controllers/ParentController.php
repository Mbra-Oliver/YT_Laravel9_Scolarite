<?php

namespace App\Http\Controllers;


use App\Models\StudentParent;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        return view('parents.list');
    }

    public function create()
    {
        return view('parents.create');
    }

    public function edit(StudentParent $parent)
    {
        return view('parents.edit', compact('parent'));
    }
}
