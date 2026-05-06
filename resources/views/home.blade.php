<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-950 text-slate-100 antialiased">
        <div class="min-h-screen">
            <header class="border-b border-white/10">
                <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-5">
                    <a href="{{ route('home') }}" class="text-lg font-semibold tracking-wide">
                        {{ $profile?->name ?? config('app.name', 'Portfolio') }}
                    </a>

                    <nav class="flex items-center gap-4 text-sm text-slate-300">
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-full border border-white/15 px-4 py-2 transition hover:border-white/30 hover:text-white">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-full border border-white/15 px-4 py-2 transition hover:border-white/30 hover:text-white">Login Admin</a>
                        @endauth
                    </nav>
                </div>
            </header>

            <main>
                <section class="mx-auto grid max-w-6xl gap-10 px-6 py-16 lg:grid-cols-[1.3fr_0.7fr] lg:items-center">
                    <div>
                        @if ($profile?->avatar)
                            <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="mb-6 h-28 w-28 rounded-full border-4 border-white/10 object-cover shadow-lg lg:h-36 lg:w-36">
                        @endif
                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-300">Portfolio</p>
                        <h1 class="mt-4 text-3xl font-bold leading-tight text-white lg:text-4xl">
                            {{ $profile?->job_title ?? 'Web Developer' }}
                        </h1>
                        <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                            {{ $profile?->about_me ?? 'Profil belum tersedia. Jalankan seeder untuk mengisi data awal portfolio.' }}
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3 text-sm">
                            @if ($profile?->github_url)
                                <a href="{{ $profile->github_url }}" target="_blank" class="rounded-full bg-cyan-400 px-5 py-3 font-semibold text-slate-950 transition hover:bg-cyan-300"><i class="fab fa-github mr-2"></i>GitHub</a>
                            @endif
                            @if ($profile?->linkedin_url)
                                <a href="{{ $profile->linkedin_url }}" target="_blank" class="rounded-full border border-white/15 px-5 py-3 font-semibold text-white transition hover:border-white/30"><i class="fab fa-linkedin mr-2"></i>LinkedIn</a>
                            @endif
                            @foreach ($socialLinks as $link)
                                <a href="{{ $link->url }}" target="_blank" class="rounded-full border border-white/15 px-5 py-3 font-semibold text-white transition hover:border-white/30 flex items-center gap-2">
                                    @if($link->icon_class) <i class="{{ $link->icon_class }}"></i> @endif
                                    {{ $link->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 p-8 backdrop-blur">
                        <h2 class="text-lg font-semibold text-white">Informasi Singkat</h2>
                        <div class="mt-6 space-y-4 text-sm text-slate-300">
                            <div>
                                <p class="text-slate-500">Nama</p>
                                <p class="mt-1 text-base text-white">{{ $profile?->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500">Email</p>
                                <p class="mt-1 text-base text-white">{{ $profile?->email ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500">Telepon</p>
                                <p class="mt-1 text-base text-white">{{ $profile?->phone ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500">Alamat</p>
                                <p class="mt-1 text-base text-white">{{ $profile?->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-6xl px-6 py-8">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-300">Skills</p>
                        <h2 class="mt-3 text-2xl font-semibold text-white">Teknologi yang digunakan</h2>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($skills as $skill)
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                <div class="flex items-center justify-between gap-4">
                                    <h3 class="font-semibold text-white">{{ $skill->name }}</h3>
                                    <span class="text-sm text-cyan-300">{{ $skill->level }}%</span>
                                </div>
                                <div class="mt-4 h-2 rounded-full bg-white/10">
                                    <div class="h-2 rounded-full bg-cyan-400" style="width: {{ min($skill->level, 100) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-white/15 p-5 text-slate-400">
                                Belum ada data skill.
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="mx-auto max-w-6xl px-6 py-16">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-300">Experience & Education</p>
                        <h2 class="mt-3 text-2xl font-semibold text-white">Riwayat Perjalanan</h2>
                    </div>

                    <div class="mt-12 grid gap-12 lg:grid-cols-2">
                        <!-- Work Experience -->
                        <div>
                            <h3 class="mb-8 text-xl font-semibold text-white flex items-center gap-3">
                                <span class="h-8 w-8 rounded-full bg-cyan-400/10 flex items-center justify-center text-cyan-400 border border-cyan-400/20">
                                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                Pengalaman Kerja
                            </h3>
                            <div class="space-y-8 border-l border-white/10 ml-4 pl-8">
                                @forelse ($experiences->where('type', 'work') as $exp)
                                    <div class="relative group">
                                        <div class="absolute -left-[41px] top-1.5 h-3 w-3 rounded-full bg-cyan-400 ring-4 ring-slate-950 transition group-hover:scale-110"></div>
                                        <p class="text-sm font-semibold text-cyan-300">
                                            {{ $exp->start_date ? $exp->start_date->format('M Y') : '' }} &mdash; 
                                            {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Sekarang' }}
                                        </p>
                                        <h4 class="mt-2 text-lg font-semibold text-white">{{ $exp->title }}</h4>
                                        <p class="mt-1 text-sm text-slate-400">{{ $exp->organization }}</p>
                                        @if($exp->description)
                                            <p class="mt-3 text-sm leading-relaxed text-slate-300">{{ $exp->description }}</p>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-sm text-slate-500">Belum ada pengalaman kerja ditambahkan.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Education -->
                        <div>
                            <h3 class="mb-8 text-xl font-semibold text-white flex items-center gap-3">
                                <span class="h-8 w-8 rounded-full bg-emerald-400/10 flex items-center justify-center text-emerald-400 border border-emerald-400/20">
                                    <i class="fa fa-graduation-cap text-xs"></i>
                                </span>
                                Pendidikan
                            </h3>
                            <div class="space-y-8 border-l border-white/10 ml-4 pl-8">
                                @forelse ($experiences->where('type', 'education') as $edu)
                                    <div class="relative group">
                                        <div class="absolute -left-[41px] top-1.5 h-3 w-3 rounded-full bg-emerald-400 ring-4 ring-slate-950 transition group-hover:scale-110"></div>
                                        <p class="text-sm font-semibold text-emerald-400">
                                            {{ $edu->start_date ? $edu->start_date->format('Y') : '' }} &mdash; 
                                            {{ $edu->end_date ? $edu->end_date->format('Y') : 'Sekarang' }}
                                        </p>
                                        <h4 class="mt-2 text-lg font-semibold text-white">{{ $edu->title }}</h4>
                                        <p class="mt-1 text-sm text-slate-400">{{ $edu->organization }}</p>
                                        @if($edu->description)
                                            <p class="mt-3 text-sm leading-relaxed text-slate-300">{{ $edu->description }}</p>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-sm text-slate-500">Belum ada riwayat pendidikan ditambahkan.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-6xl px-6 py-16">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-300">Projects</p>
                        <h2 class="mt-3 text-2xl font-semibold text-white">Proyek terbaru</h2>
                    </div>

                    <div class="mt-8 grid gap-6 lg:grid-cols-3">
                        @forelse ($projects as $project)
                            <article class="overflow-hidden rounded-3xl border border-white/10 bg-white/5">
                                @if ($project->thumbnail_url)
                                    <img
                                        src="{{ $project->thumbnail_url }}"
                                        alt="Thumbnail {{ $project->title }}"
                                        class="h-52 w-full object-cover"
                                    >
                                @endif

                                <div class="flex h-full flex-col p-6">
                                    <p class="text-sm text-cyan-300">{{ $project->slug }}</p>
                                    <h3 class="mt-3 text-xl font-semibold text-white">{{ $project->title }}</h3>
                                    <p class="mt-4 text-sm leading-7 text-slate-300">{{ $project->summary }}</p>
                                    <p class="mt-4 text-sm leading-7 text-slate-400">{{ $project->description }}</p>

                                    <div class="mt-6 flex flex-wrap gap-3 text-sm">
                                        @if ($project->project_url)
                                            <a href="{{ $project->project_url }}" target="_blank" class="rounded-full bg-white px-4 py-2 font-semibold text-slate-950 transition hover:bg-slate-200">Live Demo</a>
                                        @endif
                                        @if ($project->github_url)
                                            <a href="{{ $project->github_url }}" target="_blank" class="rounded-full border border-white/15 px-4 py-2 font-semibold text-white transition hover:border-white/30">GitHub</a>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="rounded-3xl border border-dashed border-white/15 p-6 text-slate-400 lg:col-span-3">
                                Belum ada proyek yang dipublikasikan.
                            </div>
                        @endforelse
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
