<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pengalaman & Pendidikan') }}
            </h2>

            <a href="{{ route('experiences.create') }}" class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800">
                Tambah Data
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
                    @if ($experiences->isEmpty())
                        <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
                            <h3 class="text-lg font-semibold text-gray-900">Belum ada data</h3>
                            <p class="mt-2 text-sm text-gray-600">
                                Mulai tambahkan riwayat pendidikan atau pengalaman kerja/organisasi Anda.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tipe</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Judul / Posisi</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Organisasi</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Periode</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($experiences as $exp)
                                        <tr>
                                            <td class="px-4 py-4">
                                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $exp->type === 'work' ? 'bg-indigo-100 text-indigo-800' : 'bg-emerald-100 text-emerald-800' }}">
                                                    {{ $exp->type === 'work' ? 'Pekerjaan' : 'Pendidikan' }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="font-medium text-gray-900">{{ $exp->title }}</div>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">{{ $exp->organization }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                {{ $exp->start_date ? $exp->start_date->format('M Y') : 'Unknown' }} - 
                                                {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Sekarang' }}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                <div class="flex items-center gap-3">
                                                    <a href="{{ route('experiences.edit', $exp) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Edit
                                                    </a>

                                                    <form method="POST" action="{{ route('experiences.destroy', $exp) }}" onsubmit="return confirm('Hapus data ini?');">
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
