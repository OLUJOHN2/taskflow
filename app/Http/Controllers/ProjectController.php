<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::where('owner_id', Auth::id());

        // Search feature
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->paginate(9)->withQueryString();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        Auth::user()->ownedProjects()->create($request->validated());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        abort_if($project->owner_id !== Auth::id(), 403);

        $project->load('tasks.assignee');

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        abort_if($project->owner_id !== Auth::id(), 403);

        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        abort_if($project->owner_id !== Auth::id(), 403);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}