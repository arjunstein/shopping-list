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
        <button x-data="{ dark: document.documentElement.classList.contains('dark') }"
            @click="
    dark = !dark;
    document.documentElement.classList.toggle('dark', dark);
    localStorage.setItem('theme', dark ? 'dark' : 'light')"
            class="text-gray-500 dark:text-gray-300 transition hover:text-yellow-500 dark:hover:text-yellow-400"
            title="Toggle dark mode">

            <!-- Moon Icon (when light mode, suggest dark mode) -->
            <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v1m0 16v1m8.49-8.49h1m-17 0h1m12.02-4.95l.71-.71m-12.02 0l.71.71m0 12.02l-.71.71m12.02 0l-.71-.71M12 8a4 4 0 100 8 4 4 0 000-8z" />
            </svg>

            <!-- Sun Icon (when dark mode, suggest light mode) -->
            <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">

                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
            </svg>
        </button>
        <!-- end dark mode toggle -->

        <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full" alt="User avatar">
    </div>
</header>
