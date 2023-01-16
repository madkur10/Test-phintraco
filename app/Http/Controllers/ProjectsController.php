<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::select('project_id', 'name', 'description', 'start_at', 'finish_at')->whereNull('deleted_by')
                                                                            ->get();
        return view('content/projects', [
            'title' => "Projects",
            'list_project' => $projects,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4',
            'description' => 'required',
            'start_at' => 'required',
            'finish_at' => 'required',
        ]);

        $name = $validated['name'];
        $description = $validated['description'];
        $start_at = $validated['start_at'];
        $finish_at = $validated['finish_at'];
        
        $user_id = Auth::user()->user_id;

        $insert_project = Projects::create([
            'name' => $name,
            'description' => $description,
            'start_at' => $start_at . ' ' . date('H:i:s'),
            'finish_at' => $finish_at . ' ' . date('H:i:s'),
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('projects');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4',
            'description' => 'required',
            'start_at' => 'required',
            'finish_at' => 'required',
            'project_id' => 'required',
        ]);

        $name = $validated['name'];
        $description = $validated['description'];
        $start_at = $validated['start_at'];
        $finish_at = $validated['finish_at'];
        $project_id = $validated['project_id'];
        
        $session_user_id = Auth::user()->user_id;

        $update_project = Projects::where('project_id', $project_id)->update([
            'name' => $name,
            'description' => $description,
            'start_at' => $start_at . ' ' . date('H:i:s'),
            'finish_at' => $finish_at . ' ' . date('H:i:s'),
            'updated_by' => $session_user_id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('projects');
    }

    public function destroy(Request $request) 
    {
        $project_id = $request['project_id'];
        $session_user_id = Auth::user()->user_id;
        $destroy_project = Projects::where('project_id', $project_id)->update([
            'deleted_by' => $session_user_id,
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('projects');
    }
}
