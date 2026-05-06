<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Social Links / Kontak') }}
            </h2>

            <a href="{{ route('social-links.create') }}" class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800">
                Tambah Link
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
                    @if ($socialLinks->isEmpty())
                        <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
                            <h3 class="text-lg font-semibold text-gray-900">Belum ada link tambahan</h3>
                            <p class="mt-2 text-sm text-gray-600">
                                Mulai tambahkan profil Instagram, Dribbble, atau lainnya.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Nama (Platform)</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">URL</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($socialLinks as $link)
                                        <tr>
                                            <td class="px-4 py-4">
                                                <div class="font-medium text-gray-900">{{ $link->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $link->icon_class }}</div>
                                            </td>
                                            <td class="px-4 py-4">
                                                <a href="{{ $link->url }}" target="_blank" class="text-indigo-600 hover:text-indigo-500 text-sm">{{ $link->url }}</a>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                <div class="flex items-center gap-3">
                                                    <a href="{{ route('social-links.edit', $link) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Edit
                                                    </a>

                                                    <form method="POST" action="{{ route('social-links.destroy', $link) }}" onsubmit="return confirm('Hapus link ini?');">
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
