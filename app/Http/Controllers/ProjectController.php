<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'project_name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

   // dd($request);

    Project::create([
        'project_name' =>$request->project_name,
        'start_date' =>$request->start_date,
        'end_date' =>$request->end_date,
    ]);

    return redirect()->route('projects.index')->with('success', 'Project created successfully!');
}
public function index()
{
    // Logic to fetch and display projects
}
}