<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Profile::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Rizky Ramadhan',
                'job_title' => 'Web Developer',
                'about_me' => 'Saya membangun aplikasi web yang rapi, cepat, dan berfokus pada pengalaman pengguna. Portfolio ini saya gunakan untuk menampilkan proyek terbaik, teknologi yang dikuasai, dan cara menghubungi saya.',
                'phone' => '+62 812-3456-7890',
                'address' => 'Jakarta, Indonesia',
                'avatar' => null,
                'github_url' => 'https://github.com/rizkyramadhan',
                'linkedin_url' => 'https://www.linkedin.com/in/rizkyramadhan',
            ]
        );
    }
}
