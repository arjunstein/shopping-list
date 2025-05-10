<header
    class="h-16 bg-white dark:bg-gray-800 flex items-center justify-between px-6 shadow-sm z-10 relative border-b dark:border-gray-700">
    <div class="flex items-center space-x-4">
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 dark:text-gray-300 focus:outline-none sm:hidden">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
            </svg>
        </button>
        <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full" alt="User avatar">
    </div>
</header>
