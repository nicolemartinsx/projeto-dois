<?php

namespace App\Http\Controllers;

use App\Models\Professor;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('professors.index', [
            'professors' => Professor::all()
        ]);
    }
}
