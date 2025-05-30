<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title . ' - ' . config('app.name') ?? 'Page Title' }}</title>
    <meta name="description"
        content="{{ $description ?? 'Aplikasi shopping list untuk kelola list belanja secara smart' }}">
    <meta name="author" content="{{ config('app.name') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/site.webmanifest') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.6.0/echarts.min.js"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 h-full">

    <div class="flex h-screen" x-data="{ sidebarOpen: false }">

        <!-- Sidebar -->
        @include('components._partials.sidebar')

        <!-- Overlay -->
        <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" x-transition.opacity>
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

    @include('components._partials.scripts')
    @stack('scripts')

    <script>
        document.addEventListener('livewire:navigated', () => {
            // Re-inisialisasi Alpine setelah navigasi Livewire
            window.Alpine?.initTree(document.body);
        });
    </script>
</body>

</html>
