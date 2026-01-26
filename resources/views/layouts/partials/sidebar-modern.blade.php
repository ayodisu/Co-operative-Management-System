{{-- Modern Sidebar Component --}}
<aside
    class="fixed inset-y-0 left-0 z-50 bg-white dark:bg-secondary-900 border-r border-secondary-100 dark:border-secondary-800 shadow-sidebar transition-all duration-300 overflow-hidden"
    :class="sidebarOpen ? 'w-[280px]' : 'lg:w-20 w-0'" x-cloak>

    {{-- Logo Section --}}
    <div class="h-[72px] flex items-center justify-between px-6 border-b border-secondary-100 dark:border-secondary-800">
        <a href="{{ auth('admin')->check() ? route('admin.dashboard') : route('user.dashboard') }}"
            class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center flex-shrink-0">
                <i data-lucide="landmark" class="w-5 h-5 text-white"></i>
            </div>
            <span class="font-bold text-lg text-secondary-900 dark:text-white transition-opacity duration-300"
                :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0'">
                CoopMS
            </span>
        </a>

        {{-- Collapse Toggle (Desktop) --}}
        <button @click="sidebarOpen = !sidebarOpen"
            class="hidden lg:flex w-8 h-8 items-center justify-center rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors"
            :class="sidebarOpen ? '' : 'absolute right-2'">
            <i data-lucide="panel-left-close" class="w-4 h-4 text-secondary-500" x-show="sidebarOpen"></i>
            <i data-lucide="panel-left-open" class="w-4 h-4 text-secondary-500" x-show="!sidebarOpen"></i>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto scrollbar-thin py-4 px-3">

        @if (auth('admin')->check())
            {{-- ========== ADMIN NAVIGATION ========== --}}

            <div class="nav-category" x-show="sidebarOpen">Main Menu</div>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="nav-icon"></i>
                <span x-show="sidebarOpen">Dashboard</span>
            </a>

            <a href="{{ route('admin.loans.index') }}"
                class="nav-item {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}">
                <i data-lucide="banknote" class="nav-icon"></i>
                <span x-show="sidebarOpen">Loan Requests</span>
            </a>

            <a href="{{ route('admin.repayments.index') }}"
                class="nav-item {{ request()->routeIs('admin.repayments.*') ? 'active' : '' }}">
                <i data-lucide="wallet" class="nav-icon"></i>
                <span x-show="sidebarOpen">Repayments</span>
            </a>

            <a href="{{ route('admin.savings.index') }}"
                class="nav-item {{ request()->routeIs('admin.savings.*') ? 'active' : '' }}">
                <i data-lucide="piggy-bank" class="nav-icon"></i>
                <span x-show="sidebarOpen">Savings</span>
            </a>

            <div class="nav-category" x-show="sidebarOpen">Management</div>

            <a href="{{ route('admin.members.index') }}"
                class="nav-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                <i data-lucide="users" class="nav-icon"></i>
                <span x-show="sidebarOpen">Members</span>
            </a>

            <a href="{{ route('admin.tickets.index') }}"
                class="nav-item {{ request()->routeIs('admin.tickets.*', 'admin.support.*') ? 'active' : '' }}">
                <i data-lucide="headphones" class="nav-icon"></i>
                <span x-show="sidebarOpen">Support Tickets</span>
            </a>

            <a href="{{ route('admin.reports.index') }}"
                class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i data-lucide="bar-chart-3" class="nav-icon"></i>
                <span x-show="sidebarOpen">Reports</span>
            </a>

            <div class="nav-category" x-show="sidebarOpen">System</div>

            <a href="{{ route('admin.settings.index') }}"
                class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i data-lucide="settings" class="nav-icon"></i>
                <span x-show="sidebarOpen">Settings</span>
            </a>

            <a href="{{ route('admin.activity-logs.index') }}"
                class="nav-item {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                <i data-lucide="scroll-text" class="nav-icon"></i>
                <span x-show="sidebarOpen">Activity Logs</span>
            </a>
        @else
            {{-- ========== USER NAVIGATION ========== --}}

            <div class="nav-category" x-show="sidebarOpen">Main Menu</div>

            <a href="{{ route('user.dashboard') }}"
                class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="nav-icon"></i>
                <span x-show="sidebarOpen">Dashboard</span>
            </a>

            <a href="{{ route('loans.apply') }}"
                class="nav-item {{ request()->routeIs('loans.apply') ? 'active' : '' }}">
                <i data-lucide="plus-circle" class="nav-icon"></i>
                <span x-show="sidebarOpen">Apply for Loan</span>
            </a>

            <a href="{{ route('loans.history') }}"
                class="nav-item {{ request()->routeIs('loans.history') ? 'active' : '' }}">
                <i data-lucide="history" class="nav-icon"></i>
                <span x-show="sidebarOpen">Loan History</span>
            </a>

            <a href="{{ route('loans.schedule') }}"
                class="nav-item {{ request()->routeIs('loans.schedule') ? 'active' : '' }}">
                <i data-lucide="calendar-clock" class="nav-icon"></i>
                <span x-show="sidebarOpen">Repayment Schedule</span>
            </a>

            <a href="{{ route('savings.index') }}"
                class="nav-item {{ request()->routeIs('savings.*') ? 'active' : '' }}">
                <i data-lucide="piggy-bank" class="nav-icon"></i>
                <span x-show="sidebarOpen">My Savings</span>
            </a>

            <div class="nav-category" x-show="sidebarOpen">Support</div>

            <a href="{{ route('support.index') }}"
                class="nav-item {{ request()->routeIs('support.*') ? 'active' : '' }}">
                <i data-lucide="life-buoy" class="nav-icon"></i>
                <span x-show="sidebarOpen">Get Help</span>
            </a>
        @endif

        <div class="nav-category" x-show="sidebarOpen">Account</div>

        <a href="{{ auth('admin')->check() ? route('admin.settings.index') : route('profile.edit') }}"
            class="nav-item {{ request()->routeIs('profile.*', 'admin.settings.*') ? 'active' : '' }}">
            <i data-lucide="user-circle" class="nav-icon"></i>
            <span x-show="sidebarOpen">Profile</span>
        </a>

        <form method="POST" action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}">
            @csrf
            <button type="submit"
                class="nav-item w-full text-left text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                <i data-lucide="log-out" class="nav-icon"></i>
                <span x-show="sidebarOpen">Sign Out</span>
            </button>
        </form>

    </nav>

    {{-- User Info Footer --}}
    <div class="border-t border-secondary-100 dark:border-secondary-800 p-4" x-show="sidebarOpen">
        <div class="flex items-center gap-3">
            <div class="avatar avatar-md bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">
                {{ substr(Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-secondary-900 dark:text-white truncate">
                    {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::user()->name }}
                </p>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 truncate">
                    {{ Auth::guard('admin')->check() ? 'Administrator' : 'Member' }}
                </p>
            </div>
        </div>
    </div>
</aside>

{{-- Mobile Overlay --}}
<div class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-show="sidebarOpen"
    x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="sidebarOpen = false" x-cloak>
</div>
