<div>
    <header class="px-6 py-4 shadow bg-white dark:bg-gray-800">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <h1 class="text-xl font-bold text-gray-600 dark:text-gray-200">
                {{ config('app.name') }}
            </h1>

            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 focus:outline-none">
                        <span>Halo, {{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-cloak @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg z-50 py-1 ring-1 ring-black ring-opacity-5">
                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="#"
                            class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Profile
                        </a>

                        @livewire('auth.logout')

                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" wire:navigate
                    class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                    Login
                </a>
            @endauth
        </div>
    </header>

    <main class="px-6 py-20 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                Kelola Daftar Belanjaanmu Dengan Mudah
            </h2>
            <p class="mt-6 text-lg text-gray-600 dark:text-gray-400">
                Aplikasi daftar belanja modern untuk mencatat, mengelompokkan, dan menyelesaikan kebutuhan rumah tangga
                bulananmu.
            </p>

            <div class="mt-8">
                <a href="{{ route('shop-list-now') }}" wire:navigate
                    class="inline-block px-6 py-3 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </main>

    <section class="bg-gray-50 dark:bg-gray-800 py-16">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <div class="p-6 bg-white dark:bg-gray-900 rounded shadow">
                <h3 class="text-lg font-bold">Checklist Interaktif</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Tandai item yang sudah dibeli secara instan dan
                    real-time.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-900 rounded shadow">
                <h3 class="text-lg font-bold">Kategori Dinamis</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Kelompokkan belanja berdasarkan kategori
                    favoritmu.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-900 rounded shadow">
                <h3 class="text-lg font-bold">Mode Gelap</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Dukung tampilan terang dan gelap agar nyaman
                    dipakai kapan saja.</p>
            </div>
        </div>
    </section>

    <footer class="py-6 text-center text-sm text-gray-500 dark:text-gray-400">
        © {{ now()->year }} {{ config('app.name') }}. All rights reserved.
    </footer>
</div>
