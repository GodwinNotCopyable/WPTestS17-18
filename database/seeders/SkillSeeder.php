<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'Laravel', 'icon' => 'laravel', 'level' => 90],
            ['name' => 'PHP', 'icon' => 'php', 'level' => 88],
            ['name' => 'Tailwind CSS', 'icon' => 'tailwind', 'level' => 85],
            ['name' => 'JavaScript', 'icon' => 'javascript', 'level' => 82],
            ['name' => 'MySQL', 'icon' => 'database', 'level' => 80],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                $skill
            );
        }
    }
}
