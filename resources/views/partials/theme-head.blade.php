<script>
    (() => {
        const storageKey = 'portfolio-theme';
        const defaultTheme = @json($defaultTheme ?? 'light');
        const storedTheme = window.localStorage.getItem(storageKey);
        const resolvedTheme = storedTheme === 'dark' || storedTheme === 'light'
            ? storedTheme
            : defaultTheme;

        document.documentElement.classList.toggle('dark', resolvedTheme === 'dark');
        document.documentElement.dataset.defaultTheme = defaultTheme;
        document.documentElement.dataset.theme = resolvedTheme;
    })();
</script>
