<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 dark:text-slate-100 leading-tight">
            {{ __('Theme Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="p-6 text-slate-900 dark:text-slate-100">
                    <h3 class="text-lg font-semibold">Default Theme Website</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                        Setting ini menjadi fallback global untuk pengunjung baru. Jika pengunjung menekan tombol toggle tema di website, preferensi browser mereka akan diprioritaskan.
                    </p>

                    @if (session('status'))
                        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:text-emerald-300">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('theme-settings.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <fieldset>
                            <legend class="text-sm font-medium text-slate-700 dark:text-slate-300">Pilih default theme</legend>

                            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                                @foreach ($themes as $theme)
                                    <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-slate-400 dark:border-slate-700 dark:hover:border-slate-500">
                                        <input
                                            type="radio"
                                            name="default_theme"
                                            value="{{ $theme }}"
                                            class="mt-1 border-slate-300 text-slate-900 focus:ring-slate-500 dark:border-slate-600 dark:bg-slate-950 dark:text-slate-100"
                                            @checked(old('default_theme', $themeSetting->default_theme) === $theme)
                                        >
                                        <span>
                                            <span class="block text-sm font-semibold capitalize text-slate-900 dark:text-slate-100">{{ $theme }}</span>
                                            <span class="mt-1 block text-sm text-slate-500 dark:text-slate-400">
                                                {{ $theme === 'light' ? 'Tampilan terang sebagai default awal.' : 'Tampilan gelap sebagai default awal.' }}
                                            </span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                            @error('default_theme')
                                <p class="mt-3 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </fieldset>

                        <div class="flex flex-wrap items-center gap-3">
                            <button type="submit" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-900 dark:hover:bg-slate-300">
                                Simpan Default Theme
                            </button>

                            @include('partials.theme-toggle', [
                                'class' => 'inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:text-slate-950 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:border-slate-500 dark:hover:text-white',
                            ])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
