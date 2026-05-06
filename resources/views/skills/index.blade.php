<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Skills') }}
            </h2>

            <a href="{{ route('skills.create') }}" class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800">
                Tambah Skill
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
                    @if ($skills->isEmpty())
                        <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
                            <h3 class="text-lg font-semibold text-gray-900">Belum ada skill</h3>
                            <p class="mt-2 text-sm text-gray-600">
                                Mulai tambahkan skill Anda untuk ditampilkan di halaman portfolio.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Nama Skill</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Level (%)</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($skills as $skill)
                                        <tr>
                                            <td class="px-4 py-4">
                                                <div class="font-medium text-gray-900">{{ $skill->name }}</div>
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm font-semibold text-gray-700 w-8">{{ $skill->level }}%</span>
                                                    <div class="w-24 bg-gray-200 rounded-full h-2">
                                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $skill->level }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                <div class="flex items-center gap-3">
                                                    <a href="{{ route('skills.edit', $skill) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Edit
                                                    </a>

                                                    <form method="POST" action="{{ route('skills.destroy', $skill) }}" onsubmit="return confirm('Hapus skill ini?');">
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
