<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.list');
    }
    public function create()
    {

        return view('students.create');
    }
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }
    public function show(Student $student)
    {

        return view('students.show', compact('student'));
    }
}
