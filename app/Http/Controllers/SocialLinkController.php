<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::latest()->get();
        return view('social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        $socialLink = new SocialLink();
        return view('social-links.create', compact('socialLink'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon_class' => 'nullable|string|max:255',
        ]);

        SocialLink::create($validated);

        return redirect()->route('social-links.index')->with('status', 'Social Link berhasil ditambahkan!');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon_class' => 'nullable|string|max:255',
        ]);

        $socialLink->update($validated);

        return redirect()->route('social-links.index')->with('status', 'Social Link berhasil diperbarui!');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('social-links.index')->with('status', 'Social Link berhasil dihapus!');
    }
}
