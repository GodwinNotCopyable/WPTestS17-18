<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the portfolio landing page.
     */
    public function __invoke(): View
    {
        $hasProfilesTable = Schema::hasTable('profiles');
        $hasProjectsTable = Schema::hasTable('projects');
        $hasSkillsTable = Schema::hasTable('skills');
        $hasSocialLinksTable = Schema::hasTable('social_links');
        $hasExperiencesTable = Schema::hasTable('experiences');

        return view('home', [
            'profile' => $hasProfilesTable ? Profile::query()->first() : null,
            'projects' => $hasProjectsTable
                ? Project::query()->where('is_published', true)->latest()->take(6)->get()
                : collect(),
            'skills' => $hasSkillsTable
                ? Skill::query()->orderByDesc('level')->get()
                : collect(),
            'socialLinks' => $hasSocialLinksTable
                ? \App\Models\SocialLink::all()
                : collect(),
            'experiences' => $hasExperiencesTable
                ? \App\Models\Experience::orderByDesc('start_date')->get()
                : collect(),
        ]);
    }
}
