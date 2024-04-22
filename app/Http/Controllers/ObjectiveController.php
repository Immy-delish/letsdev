<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectiveController extends Controller
{
    public function create()
    {
        $projects = Project::all();
        dd($projects); // Add this line for debugging

        return view('objectives.create', compact('projects'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id'
        ]);

        Objective::create([
            'name'=>$request->name,
            'project_id'=>$request->project_id,
        ]);

        return redirect('/objectives');
    }

    public function index()
    {
        $projects = DB::table('projects')->select('id as id','project_name as name')->get();        
        //dd($projects);
        return view('/objectives', compact('projects'));
    }
}
