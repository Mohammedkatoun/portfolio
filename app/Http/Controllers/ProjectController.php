<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $query = Project::published();

        if (request('q')) {
            $q = trim((string) request('q'));
            $query->where(function ($sub) use ($q) {
                $sub
                    ->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('long_description', 'like', "%{$q}%");
            });
        }

        if (request('tech')) {
            $tech = trim((string) request('tech'));
            if ($tech !== '') {
                $query->whereJsonContains('technologies', $tech);
            }
        }

        $projects = $query->paginate(9)->withQueryString();

        $availableTechs = Project::published()
            ->whereNotNull('technologies')
            ->get()
            ->flatMap(fn ($p) => is_array($p->technologies) ? $p->technologies : [])
            ->map(fn ($t) => trim((string) $t))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('pages.projects.index', compact('projects', 'availableTechs'));
    }

    public function show(Project $project)
    {
        return view('pages.projects.show', compact('project'));
    }

    // Admin methods
    public function adminIndex()
    {
        $this->authorize('isAdmin');
        $projects = Project::orderBy('order')->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $this->authorize('isAdmin');
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'status' => 'required|in:completed,in_progress,planning',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->has('technologies')) {
            $validated['technologies'] = explode(',', $request->input('technologies'));
        }

        $validated['user_id'] = auth()->id();
        $validated['order'] = Project::max('order') + 1;

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        $this->authorize('isAdmin');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('isAdmin');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'status' => 'required|in:completed,in_progress,planning',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->has('technologies')) {
            $validated['technologies'] = explode(',', $request->input('technologies'));
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $this->authorize('isAdmin');
        $project->delete();
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
