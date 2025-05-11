@push('scripts')
    <script>
        // function to toggle dark mode
        function applyTheme() {
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        // when page loaded
        applyTheme();

        // when licewire navigated
        document.addEventListener("livewire:navigated", () => {
            applyTheme();
        });
    </script>
@endpush
