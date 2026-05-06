<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('projects.index', [
            'projects' => Project::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('projects.create', [
            'project' => new Project(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProject($request);
        $projectData = Arr::except($validated, ['thumbnail', 'remove_thumbnail']);

        Project::create([
            ...$projectData,
            'slug' => $this->generateUniqueSlug($validated['title']),
            'thumbnail' => $request->hasFile('thumbnail')
                ? $request->file('thumbnail')->store('projects/thumbnails', 'public')
                : null,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()
            ->route('projects.index')
            ->with('status', 'Project berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        return view('projects.edit', [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $this->validateProject($request);
        $projectData = Arr::except($validated, ['thumbnail', 'remove_thumbnail']);

        $projectData['slug'] = $project->title === $validated['title']
            ? $project->slug
            : $this->generateUniqueSlug($validated['title'], $project);
        $projectData['thumbnail'] = $project->thumbnail;
        $projectData['is_published'] = $request->boolean('is_published');

        if ($request->boolean('remove_thumbnail')) {
            $this->deleteStoredThumbnail($project);
            $projectData['thumbnail'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            $this->deleteStoredThumbnail($project);
            $projectData['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        $project->update($projectData);

        return redirect()
            ->route('projects.index')
            ->with('status', 'Project berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->deleteStoredThumbnail($project);
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('status', 'Project berhasil dihapus.');
    }

    /**
     * Validate project input.
     *
     * @return array<string, mixed>
     */
    protected function validateProject(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string'],
            'description' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
            'remove_thumbnail' => ['nullable', 'boolean'],
        ]);
    }

    /**
     * Generate a unique slug for the project.
     */
    protected function generateUniqueSlug(string $title, ?Project $ignoreProject = null): string
    {
        $baseSlug = Str::slug($title);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'project';

        $slug = $baseSlug;
        $counter = 1;

        while (
            Project::query()
                ->when($ignoreProject, fn ($query) => $query->whereKeyNot($ignoreProject->getKey()))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Delete the thumbnail file from storage when it belongs to the public disk.
     */
    protected function deleteStoredThumbnail(Project $project): void
    {
        if (! $project->thumbnail_path) {
            return;
        }

        Storage::disk('public')->delete($project->thumbnail_path);
    }
}
