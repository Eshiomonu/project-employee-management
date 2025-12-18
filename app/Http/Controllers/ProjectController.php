<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show(Project $project)
    {
        $this->authorize('view', $project);

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
