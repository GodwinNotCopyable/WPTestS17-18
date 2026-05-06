<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ThemeSettingController extends Controller
{
    public function edit(): View
    {
        return view('theme-settings.edit', [
            'themeSetting' => ThemeSetting::singleton(),
            'themes' => ThemeSetting::options(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'default_theme' => ['required', 'string', Rule::in(ThemeSetting::options())],
        ]);

        $themeSetting = ThemeSetting::singleton();
        $themeSetting->fill($validated);
        $themeSetting->save();

        return redirect()
            ->route('theme-settings.edit')
            ->with('status', 'Default theme berhasil diperbarui.');
    }
}
