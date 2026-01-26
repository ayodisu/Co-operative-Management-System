<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: window.innerWidth >= 1024, darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); })" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | Cooperative Management</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons - Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')
</head>

<body class="bg-secondary-50 dark:bg-secondary-950 antialiased">

    <!-- Sidebar -->
    @include('layouts.partials.sidebar-modern')

    <!-- Main Wrapper -->
    <div class="transition-all duration-300" :class="sidebarOpen ? 'lg:ml-[280px]' : 'lg:ml-20'">

        <!-- Topbar -->
        @include('layouts.partials.topbar-modern')

        <!-- Main Content -->
        <main class="pt-[72px] min-h-screen">
            <div class="p-4 lg:p-8">

                <!-- Flash Messages -->
                @if (session('success'))
                    <div
                        class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 animate-in">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                        <p class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl flex items-center gap-3 animate-in">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                        <p class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')

            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-secondary-200 dark:border-secondary-800 py-6 px-8">
            <div
                class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-secondary-500 dark:text-secondary-400">
                <p>&copy; {{ date('Y') }} Cooperative Management System. All rights reserved.</p>
                <p class="flex items-center gap-1">
                    Made with <i data-lucide="heart" class="w-4 h-4 text-red-500"></i> for members
                </p>
            </div>
        </footer>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>

    @yield('scripts')
</body>

</html>
