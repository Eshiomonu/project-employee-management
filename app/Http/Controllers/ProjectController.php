<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->projects()->withCount('employees');

        // Filter by status if provided
        if($request->status) {
            $query->where('status', $request->status);
        }

        // search by name if provided
        if($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Paginate results
        $projects = $query->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:planned,active,on-hold,completed,cancelled',
        ]);

        $project = auth()->user()->projects()->create($validated);

        return redirect()->route('projects.show', $project)->with('status', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->loadCount('employees');

        return view('projects.show', compact('project'));
    }   

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')->with('status', 'Project deleted successfully.');
    }

    public function restore(Project $project)
    {
        $this->authorize('restore', $project);

        $project->restore();

        return redirect()->route('projects.index')->with('status', 'Project restored successfully.');
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $project)->with('status', 'Project updated successfully.');
    }
}
