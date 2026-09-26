<?php

namespace App\Http\Controllers;

class SubjectController extends Controller
{
    public function index()
    {
        return view('subjects.index');
    }
}