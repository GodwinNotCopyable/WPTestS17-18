<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::latest()->get();
        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        $skill = new Skill();
        return view('skills.create', compact('skill'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:0|max:100',
        ]);

        Skill::create($validated);

        return redirect()->route('skills.index')->with('status', 'Skill berhasil ditambahkan!');
    }

    public function edit(Skill $skill)
    {
        return view('skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:0|max:100',
        ]);

        $skill->update($validated);

        return redirect()->route('skills.index')->with('status', 'Skill berhasil diperbarui!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('skills.index')->with('status', 'Skill berhasil dihapus!');
    }
}
