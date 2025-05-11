<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, darkMode: JSON.parse(localStorage.getItem('darkMode') || 'false') }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', JSON.stringify(val)))" :class="{ 'dark': darkMode }" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title . ' - ' . config('app.name') ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 h-full">

    <div class="flex h-screen">

        <!-- Sidebar -->
        @include('components._partials.sidebar')

        <!-- Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 sm:hidden" x-transition.opacity>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            @include('components._partials.navbar')

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto p-6">

                @include('components._partials.alerts')

                {{ $slot }}

            </main>
        </div>
    </div>

    @livewireScripts

</body>

</html>
