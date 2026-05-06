<button
    type="button"
    data-theme-toggle
    class="{{ $class ?? 'inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white/80 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:text-slate-950 dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:border-slate-500 dark:hover:text-white' }}"
>
    <span class="relative flex h-5 w-5 items-center justify-center" aria-hidden="true">
        <svg data-theme-icon-dark viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z" />
        </svg>
        <svg data-theme-icon-light viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="hidden h-4 w-4">
            <circle cx="12" cy="12" r="4" />
            <path stroke-linecap="round" d="M12 2v2.5M12 19.5V22M4.93 4.93l1.77 1.77M17.3 17.3l1.77 1.77M2 12h2.5M19.5 12H22M4.93 19.07l1.77-1.77M17.3 6.7l1.77-1.77" />
        </svg>
    </span>
    <span data-theme-label>Dark Mode</span>
</button>
