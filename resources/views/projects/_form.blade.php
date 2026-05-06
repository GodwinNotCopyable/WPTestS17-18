<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @isset($method)
        @if ($method !== 'POST')
            @method($method)
        @endif
    @endisset

    <div>
        <x-input-label for="title" :value="'Judul Proyek'" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $project->title)" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div>
        <x-input-label for="summary" :value="'Ringkasan Singkat'" />
        <textarea id="summary" name="summary" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('summary', $project->summary) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('summary')" />
    </div>

    <div>
        <x-input-label for="description" :value="'Deskripsi Lengkap'" />
        <textarea id="description" name="description" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $project->description) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <x-input-label for="project_url" :value="'URL Demo'" />
            <x-text-input id="project_url" name="project_url" type="url" class="mt-1 block w-full" :value="old('project_url', $project->project_url)" />
            <x-input-error class="mt-2" :messages="$errors->get('project_url')" />
        </div>

        <div>
            <x-input-label for="github_url" :value="'URL GitHub'" />
            <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" :value="old('github_url', $project->github_url)" />
            <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
        </div>
    </div>

    <div>
        <x-input-label for="thumbnail" :value="'Thumbnail Proyek'" />
        <input
            id="thumbnail"
            name="thumbnail"
            type="file"
            accept="image/*"
            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm file:mr-4 file:rounded-md file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-800 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500"
        >
        <p class="mt-2 text-sm text-gray-500">
            Upload file gambar ke storage publik. Format: JPG, PNG, WEBP, atau GIF. Maksimal 2 MB.
        </p>
        <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />

        @if ($project->thumbnail_url)
            <div class="mt-4 rounded-xl border border-gray-200 p-4">
                <p class="text-sm font-medium text-gray-700">Thumbnail saat ini</p>
                <img
                    src="{{ $project->thumbnail_url }}"
                    alt="Thumbnail {{ $project->title }}"
                    class="mt-3 h-48 w-full rounded-lg object-cover"
                >

                <label for="remove_thumbnail" class="mt-4 inline-flex items-center gap-3">
                    <input
                        id="remove_thumbnail"
                        name="remove_thumbnail"
                        type="checkbox"
                        value="1"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        {{ old('remove_thumbnail') ? 'checked' : '' }}
                    >
                    <span class="text-sm text-gray-700">Hapus thumbnail lama saat menyimpan perubahan</span>
                </label>
            </div>
        @endif
    </div>

    <label for="is_published" class="inline-flex items-center gap-3">
        <input
            id="is_published"
            name="is_published"
            type="checkbox"
            value="1"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
            {{ old('is_published', $project->is_published ?? true) ? 'checked' : '' }}
        >
        <span class="text-sm text-gray-700">Langsung publikasikan proyek ini</span>
    </label>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel }}</x-primary-button>
        <a href="{{ route('projects.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            Kembali ke daftar proyek
        </a>
    </div>
</form>
