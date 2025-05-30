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
</head>

<body class="bg-gray-50 dark:bg-gray-800">

    {{ $slot }}

    @livewireScripts

    @include('components._partials.scripts')
    @stack('scripts')

    <script>
        document.addEventListener('livewire:navigated', () => {
            // Re-inisialisasi Alpine setelah navigasi Livewire
            window.Alpine?.initTree(document.body);
        });
</body>

</html>
