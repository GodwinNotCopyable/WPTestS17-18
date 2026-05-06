<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderByDesc('start_date')->get();
        return view('experiences.index', compact('experiences'));
    }

    public function create()
    {
        $experience = new Experience();
        return view('experiences.create', compact('experience'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'type' => 'required|in:work,education',
        ]);

        Experience::create($validated);

        return redirect()->route('experiences.index')->with('status', 'Experience/Education berhasil ditambahkan!');
    }

    public function edit(Experience $experience)
    {
        return view('experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'type' => 'required|in:work,education',
        ]);

        $experience->update($validated);

        return redirect()->route('experiences.index')->with('status', 'Experience/Education berhasil diperbarui!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('experiences.index')->with('status', 'Experience/Education berhasil dihapus!');
    }
}
