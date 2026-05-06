<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="type" class="block text-sm font-medium text-gray-700">Jenis Riwayat</label>
        <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <option value="work" {{ old('type', $experience->type) === 'work' ? 'selected' : '' }}>Pengalaman Kerja / Organisasi</option>
            <option value="education" {{ old('type', $experience->type) === 'education' ? 'selected' : '' }}>Pendidikan</option>
        </select>
        @error('type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul / Posisi / Gelar</label>
        <input type="text" name="title" id="title" value="{{ old('title', $experience->title) }}" placeholder="Contoh: Frontend Developer, Sarjana Komputer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="organization" class="block text-sm font-medium text-gray-700">Institusi / Perusahaan</label>
        <input type="text" name="organization" id="organization" value="{{ old('organization', $experience->organization) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('organization') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('start_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai (Kosongkan jika masih berlangsung)</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('end_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $experience->description) }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('experiences.index') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Batal
        </a>
        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ $submitLabel }}
        </button>
    </div>
</form>
