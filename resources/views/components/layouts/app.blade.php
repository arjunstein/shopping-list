<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, darkMode: JSON.parse(localStorage.getItem('darkMode') || 'false') }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', JSON.stringify(val)))"
      :class="{ 'dark': darkMode }" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 h-full">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 shadow-lg sm:translate-x-0 sm:static sm:inset-0">
            <div class="h-16 flex items-center justify-center border-b dark:border-gray-700">
                <span class="text-lg font-bold">MyApp</span>
            </div>
            <nav class="mt-6 px-4">
                <a href="#"
                    class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18" />
                    </svg>
                    Dashboard
                </a>
                <a href="#"
                    class="flex items-center px-4 py-2 mt-2 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Reports
                </a>
            </nav>
        </aside>

        <!-- Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 sm:hidden" x-transition.opacity></div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header
                class="h-16 bg-white dark:bg-gray-800 flex items-center justify-between px-6 shadow-sm z-10 relative border-b dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="text-gray-500 dark:text-gray-300 focus:outline-none sm:hidden">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Toggle dark mode -->
                    <button @click="darkMode = !darkMode" class="text-gray-600 dark:text-gray-300">
                        <svg x-show="!darkMode" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v1m0 16v1m8.66-8.66h-1M4.34 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="darkMode" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                        </svg>
                    </button>
                    <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full" alt="User avatar">
                </div>
            </header>

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Blank Page</h2>
                    <p class="text-sm mt-2">Start building your dashboard here with dark mode support.</p>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
