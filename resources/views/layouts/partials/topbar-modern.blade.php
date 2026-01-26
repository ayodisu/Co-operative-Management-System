{{-- Modern Topbar Component --}}
<header
    class="fixed top-0 right-0 h-[72px] bg-white/80 dark:bg-secondary-900/80 backdrop-blur-xl border-b border-secondary-100 dark:border-secondary-800 z-30 transition-all duration-300"
    :class="sidebarOpen ? 'lg:left-[280px]' : 'lg:left-20'" style="left: 0;">

    <div class="h-full flex items-center justify-between px-4 lg:px-6">

        {{-- Left: Mobile Menu + Search --}}
        <div class="flex items-center gap-4">
            {{-- Mobile Menu Toggle --}}
            <button @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors">
                <i data-lucide="menu" class="w-5 h-5 text-secondary-600 dark:text-secondary-400"></i>
            </button>

            {{-- Search (Hidden on mobile) --}}
            <div class="hidden md:flex items-center">
                <div class="relative">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
                    <input type="text" placeholder="Search..."
                        class="w-64 pl-10 pr-4 py-2.5 bg-secondary-50 dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700 rounded-xl text-sm text-secondary-700 dark:text-secondary-200 placeholder:text-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                </div>
            </div>
        </div>

        {{-- Right: Actions --}}
        <div class="flex items-center gap-2">

            {{-- Dark Mode Toggle --}}
            <button @click="darkMode = !darkMode"
                class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors">
                <i data-lucide="sun" class="w-5 h-5 text-secondary-600 dark:text-secondary-400" x-show="darkMode"></i>
                <i data-lucide="moon" class="w-5 h-5 text-secondary-600 dark:text-secondary-400" x-show="!darkMode"></i>
            </button>

            {{-- Notifications Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors relative">
                    <i data-lucide="bell" class="w-5 h-5 text-secondary-600 dark:text-secondary-400"></i>
                    @if (Auth::check() && Auth::user()->unreadNotifications && Auth::user()->unreadNotifications->count() > 0)
                        <span
                            class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white dark:border-secondary-900"></span>
                    @endif
                </button>

                {{-- Notifications Panel --}}
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-white dark:bg-secondary-800 rounded-2xl shadow-lg border border-secondary-100 dark:border-secondary-700 overflow-hidden z-50"
                    x-cloak>

                    <div
                        class="p-4 border-b border-secondary-100 dark:border-secondary-700 flex items-center justify-between">
                        <h3 class="font-semibold text-secondary-900 dark:text-white">Notifications</h3>
                        @if (Auth::check() && Auth::user()->unreadNotifications && Auth::user()->unreadNotifications->count() > 0)
                            <a href="{{ route('notifications.markAsRead') }}"
                                class="text-xs text-primary hover:underline">Mark all read</a>
                        @endif
                    </div>

                    <div class="max-h-80 overflow-y-auto scrollbar-thin">
                        @if (Auth::check() && Auth::user()->unreadNotifications && Auth::user()->unreadNotifications->count() > 0)
                            @foreach (Auth::user()->unreadNotifications->take(5) as $notification)
                                <div
                                    class="p-4 hover:bg-secondary-50 dark:hover:bg-secondary-700/50 transition-colors border-b border-secondary-100 dark:border-secondary-700 last:border-0">
                                    <p class="text-sm text-secondary-700 dark:text-secondary-300">
                                        {{ $notification->data['message'] ?? 'New notification' }}
                                    </p>
                                    <p class="text-xs text-secondary-400 mt-1">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <div class="p-8 text-center">
                                <i data-lucide="bell-off"
                                    class="w-8 h-8 text-secondary-300 dark:text-secondary-600 mx-auto mb-2"></i>
                                <p class="text-sm text-secondary-500 dark:text-secondary-400">No new notifications</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- User Menu Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors">
                    <div
                        class="avatar avatar-sm bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">
                        {{ substr(Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-medium text-secondary-900 dark:text-white">
                            {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::user()->name }}
                        </p>
                    </div>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-secondary-400 hidden sm:block"></i>
                </button>

                {{-- User Dropdown --}}
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-56 bg-white dark:bg-secondary-800 rounded-2xl shadow-lg border border-secondary-100 dark:border-secondary-700 overflow-hidden z-50"
                    x-cloak>

                    <div class="p-3 border-b border-secondary-100 dark:border-secondary-700">
                        <p class="font-semibold text-secondary-900 dark:text-white">
                            {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::user()->name }}
                        </p>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">
                            {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->email : Auth::user()->email }}
                        </p>
                    </div>

                    <div class="p-2">
                        <a href="{{ auth('admin')->check() ? route('admin.settings.index') : route('profile.edit') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-secondary-700 dark:text-secondary-300 hover:bg-secondary-100 dark:hover:bg-secondary-700 transition-colors">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            <span class="text-sm">My Profile</span>
                        </a>

                        @if (!auth('admin')->check())
                            <a href="{{ route('savings.index') }}"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-secondary-700 dark:text-secondary-300 hover:bg-secondary-100 dark:hover:bg-secondary-700 transition-colors">
                                <i data-lucide="piggy-bank" class="w-4 h-4"></i>
                                <span class="text-sm">My Savings</span>
                            </a>
                        @endif
                    </div>

                    <div class="p-2 border-t border-secondary-100 dark:border-secondary-700">
                        <form method="POST"
                            action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                <span class="text-sm">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
