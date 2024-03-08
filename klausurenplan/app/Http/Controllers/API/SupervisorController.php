<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supervisors = Supervisor::all();
        return response()->json($supervisors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email',
        ]);
    
        $supervisor = Supervisor::create($validatedData);
        return response()->json($supervisor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supervisor $supervisor)
    {
        return response()->json($supervisor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supervisor $supervisor)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
        ]);

        $supervisor->update($validatedData);
        return response()->json($supervisor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supervisor $supervisor)
    {
        $supervisor->delete();
        return response()->json(null, 204);
    }
}
