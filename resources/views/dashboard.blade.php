<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold text-gray-900">Kelola Proyek</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Lihat daftar proyek yang sudah ada dan tambahkan proyek baru untuk portfolio Anda.
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('projects.index') }}" class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800">
                                Lihat Daftar Proyek
                            </a>
                            <a href="{{ route('projects.create') }}" class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                                Tambah Proyek
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold text-gray-900">Akses Cepat</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Gunakan navigasi Breeze di atas untuk berpindah ke dashboard, manajemen proyek, dan pengaturan profil akun.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
