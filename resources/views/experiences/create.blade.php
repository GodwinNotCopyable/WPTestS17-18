<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('experiences._form', [
                        'action' => route('experiences.store'),
                        'method' => 'POST',
                        'experience' => $experience,
                        'submitLabel' => 'Simpan Data',
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
