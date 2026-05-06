<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first() ?? new Profile();
        return view('portfolio-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'about_me' => 'required|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'github_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $profile = Profile::first() ?? new Profile();
        
        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->fill($validated)->save();

        return redirect()->route('portfolio-profile.edit')->with('status', 'Profil portofolio berhasil diperbarui!');
    }
}
