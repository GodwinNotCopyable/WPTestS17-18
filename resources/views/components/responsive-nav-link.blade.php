@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full border-l-4 border-slate-900 bg-slate-100 py-2 ps-3 pe-4 text-start text-base font-medium text-slate-900 transition duration-150 ease-in-out focus:border-slate-700 focus:bg-slate-200 focus:text-slate-950 focus:outline-none dark:border-slate-100 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-slate-300 dark:focus:bg-slate-700'
            : 'block w-full border-l-4 border-transparent py-2 ps-3 pe-4 text-start text-base font-medium text-slate-600 transition duration-150 ease-in-out hover:border-slate-300 hover:bg-slate-50 hover:text-slate-800 focus:border-slate-300 focus:bg-slate-50 focus:text-slate-800 focus:outline-none dark:text-slate-400 dark:hover:border-slate-600 dark:hover:bg-slate-800 dark:hover:text-slate-200 dark:focus:border-slate-600 dark:focus:bg-slate-800 dark:focus:text-slate-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
