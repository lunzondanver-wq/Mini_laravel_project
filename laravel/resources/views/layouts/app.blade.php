<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Personal Task Manager')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' };

        // Apply saved theme before the page paints, so there's no flash
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-slate-900 min-h-screen transition-colors">
    <div class="h-1.5 bg-slate-900 dark:bg-slate-700"></div>

    <div class="max-w-5xl mx-auto px-6 py-10">
        <div class="flex justify-end mb-4">
            <button onclick="toggleTheme()"
                class="text-sm font-medium px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">
                <span id="theme-label">🌙 Dark mode</span>
            </button>
        </div>

        @yield('content')
    </div>

    <script>
        function updateLabel() {
            document.getElementById('theme-label').textContent =
                document.documentElement.classList.contains('dark') ? '☀️ Light mode' : '🌙 Dark mode';
        }
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
            updateLabel();
        }
        updateLabel();
    </script>
</body>
</html>