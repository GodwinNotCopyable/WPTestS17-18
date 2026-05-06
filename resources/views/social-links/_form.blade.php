<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Platform</label>
        <input type="text" name="name" id="name" value="{{ old('name', $socialLink->name) }}" placeholder="Contoh: Instagram" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
        <input type="url" name="url" id="url" value="{{ old('url', $socialLink->url) }}" placeholder="https://instagram.com/..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="icon_class" class="block text-sm font-medium text-gray-700">Icon Class (Opsional)</label>
        <input type="text" name="icon_class" id="icon_class" value="{{ old('icon_class', $socialLink->icon_class) }}" placeholder="Contoh: fab fa-instagram" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('icon_class') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('social-links.index') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Batal
        </a>
        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ $submitLabel }}
        </button>
    </div>
</form>
