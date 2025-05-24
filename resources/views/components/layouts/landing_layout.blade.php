<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' - ' . config('app.name') ?? 'Page title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased">

    {{ $slot }}

    @livewireScripts
    @include('components._partials.scripts')
    @stack('scripts')

</body>

</html>
