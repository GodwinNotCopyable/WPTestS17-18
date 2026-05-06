import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const THEME_STORAGE_KEY = 'portfolio-theme';

const getStoredTheme = () => {
    const theme = window.localStorage.getItem(THEME_STORAGE_KEY);

    return theme === 'dark' || theme === 'light' ? theme : null;
};

const getDefaultTheme = () => {
    const theme = document.documentElement.dataset.defaultTheme;

    return theme === 'dark' ? 'dark' : 'light';
};

const applyTheme = (theme, persist = true) => {
    const resolvedTheme = theme === 'dark' ? 'dark' : 'light';

    document.documentElement.classList.toggle('dark', resolvedTheme === 'dark');
    document.documentElement.dataset.theme = resolvedTheme;

    if (persist) {
        window.localStorage.setItem(THEME_STORAGE_KEY, resolvedTheme);
    }

    syncThemeToggleButtons();
};

const syncThemeToggleButtons = () => {
    const activeTheme = document.documentElement.dataset.theme === 'dark' ? 'dark' : 'light';

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        const label = button.querySelector('[data-theme-label]');
        const darkIcon = button.querySelector('[data-theme-icon-dark]');
        const lightIcon = button.querySelector('[data-theme-icon-light]');

        if (label) {
            label.textContent = activeTheme === 'dark' ? 'Light Mode' : 'Dark Mode';
        }

        if (darkIcon) {
            darkIcon.classList.toggle('hidden', activeTheme === 'dark');
        }

        if (lightIcon) {
            lightIcon.classList.toggle('hidden', activeTheme !== 'dark');
        }

        button.setAttribute('aria-pressed', activeTheme === 'dark' ? 'true' : 'false');
    });
};

document.addEventListener('DOMContentLoaded', () => {
    const initialTheme = getStoredTheme() ?? getDefaultTheme();

    applyTheme(initialTheme, false);

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const nextTheme = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
            applyTheme(nextTheme);
        });
    });
});

window.addEventListener('storage', (event) => {
    if (event.key !== THEME_STORAGE_KEY) {
        return;
    }

    applyTheme(getStoredTheme() ?? getDefaultTheme(), false);
});
