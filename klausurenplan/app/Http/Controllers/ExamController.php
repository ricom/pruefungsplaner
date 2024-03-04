<?php

namespace App\Http\Controllers;

use App\Models\Semester;

class ExamController extends Controller
{
    public function uploadForm()
    {
        $semesters = Semester::all();
        return view('upload', compact('semesters'));
    }
}