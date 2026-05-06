<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2">
                <div class="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-slate-900">
                    <div class="p-6 text-slate-900 dark:text-slate-100">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Kelola Proyek</h3>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                            Lihat daftar proyek yang sudah ada dan tambahkan proyek baru untuk portfolio Anda.
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('projects.index') }}" class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-900 dark:hover:bg-slate-300">
                                Lihat Daftar Proyek
                            </a>
                            <a href="{{ route('projects.create') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                                Tambah Proyek
                            </a>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-slate-900">
                    <div class="p-6 text-slate-900 dark:text-slate-100">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Akses Cepat</h3>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                            Gunakan navigasi Breeze di atas untuk berpindah ke dashboard, manajemen proyek, dan pengaturan profil akun.
                        </p>

                        <div class="mt-6">
                            <a href="{{ route('theme-settings.edit') }}" class="inline-flex items-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                                Atur Theme Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
