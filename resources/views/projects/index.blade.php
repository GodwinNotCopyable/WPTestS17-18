<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Proyek') }}
            </h2>

            <a href="{{ route('projects.create') }}" class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800">
                Tambah Proyek
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($projects->isEmpty())
                        <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
                            <h3 class="text-lg font-semibold text-gray-900">Belum ada proyek</h3>
                            <p class="mt-2 text-sm text-gray-600">
                                Mulai tambahkan proyek pertama agar portfolio Anda tampil lebih lengkap.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Thumbnail</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Judul</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Slug</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Link</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td class="px-4 py-4">
                                                @if ($project->thumbnail_url)
                                                    <img
                                                        src="{{ $project->thumbnail_url }}"
                                                        alt="Thumbnail {{ $project->title }}"
                                                        class="h-16 w-24 rounded-lg object-cover"
                                                    >
                                                @else
                                                    <div class="flex h-16 w-24 items-center justify-center rounded-lg bg-gray-100 text-xs font-medium text-gray-400">
                                                        No Image
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="font-medium text-gray-900">{{ $project->title }}</div>
                                                <div class="mt-1 text-sm text-gray-500">{{ $project->summary }}</div>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">{{ $project->slug }}</td>
                                            <td class="px-4 py-4">
                                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $project->is_published ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                    {{ $project->is_published ? 'Published' : 'Draft' }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                @if ($project->project_url)
                                                    <a href="{{ $project->project_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-500">
                                                        Demo
                                                    </a>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                <div class="flex items-center gap-3">
                                                    <a href="{{ route('projects.edit', $project) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Edit
                                                    </a>

                                                    <form method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('Hapus proyek ini?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="font-medium text-red-600 hover:text-red-500">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
