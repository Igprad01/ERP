<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'PERP') : config('app.name', 'PERP') }}
    </title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        try {
            if (JSON.parse(localStorage.getItem('darkMode') ?? 'false')) {
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    </script>
</head>

<body x-data="{ page: 'dashboard', loaded: true, darkMode: $persist(false), stickyMenu: false, sidebarToggle: false, scrollTop: false }" x-init="$watch('darkMode', value => {
    document.documentElement.classList.toggle('dark', value);
    localStorage.setItem('darkMode', JSON.stringify(value));
})" :class="{ 'dark bg-gray-900': darkMode === true }"
    class="font-outfit bg-gray-50 text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100">
    <div class="flex h-screen overflow-hidden">
        @include('layouts.tailadmin.sidebar')

        <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
            <div x-show="sidebarToggle" x-cloak @click="sidebarToggle = false"
                class="fixed inset-0 z-9998 bg-gray-900/50 xl:hidden"></div>

            @include('layouts.tailadmin.header', ['title' => $title ?? 'Dashboard'])

            <main class="flex-1">
                <div class="mx-auto w-full max-w-none p-4 md:p-6">
                    {{ $slot }}
                </div>
            </main>

            <footer class="px-4 pb-6 md:px-6">
                <p class="text-center text-sm text-gray-400 dark:text-gray-500">
                    {{ config('app.name', 'PERP') }} &copy; {{ date('Y') }} — Template TailAdmin, fitur menyusul.
                </p>
            </footer>
        </div>
    </div>
</body>

</html>
