<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Aplikasi Portfolio Pribadi',
                'slug' => 'aplikasi-portfolio-pribadi',
                'summary' => 'Website portfolio personal untuk menampilkan profil, skill, dan proyek unggulan.',
                'description' => 'Proyek ini dibangun dengan Laravel dan Tailwind CSS untuk membuat halaman profil yang cepat, bersih, dan mudah dikelola melalui dashboard admin.',
                'thumbnail' => null,
                'project_url' => 'https://portfolio.test',
                'github_url' => 'https://github.com/rizkyramadhan/portfolio',
                'is_published' => true,
            ],
            [
                'title' => 'Sistem Manajemen Tugas',
                'slug' => 'sistem-manajemen-tugas',
                'summary' => 'Aplikasi task management sederhana untuk tim kecil.',
                'description' => 'Fitur utama mencakup pembuatan tugas, pengelompokan status, dan halaman ringkasan progres untuk membantu monitoring pekerjaan harian.',
                'thumbnail' => null,
                'project_url' => null,
                'github_url' => 'https://github.com/rizkyramadhan/task-manager',
                'is_published' => true,
            ],
            [
                'title' => 'Website Company Profile UMKM',
                'slug' => 'website-company-profile-umkm',
                'summary' => 'Company profile responsif untuk membantu UMKM tampil profesional secara online.',
                'description' => 'Website ini fokus pada penyajian informasi layanan, katalog singkat, dan kontak bisnis dengan tampilan yang ringan serta mudah diakses di perangkat mobile.',
                'thumbnail' => null,
                'project_url' => null,
                'github_url' => 'https://github.com/rizkyramadhan/company-profile',
                'is_published' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }
    }
}
