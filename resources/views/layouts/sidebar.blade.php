<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">


        {{-- Shared --}}
        <li class="nav-item nav-category">Navigation</li>

        @if (auth()->user()?->is_admin)
            {{-- Admin Menu --}}
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.loans.index') }}">
                    <i class="menu-icon mdi mdi-bank"></i>
                    <span class="menu-title">Loan Requests</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.repayments.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.repayments.index') }}">
                    <i class="menu-icon mdi mdi-cash-multiple"></i>
                    <span class="menu-title">Repayment Tracking</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.members.index') }}">
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                    <span class="menu-title">Manage Members</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.tickets.index', 'admin.support.show') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.tickets.index') }}">
                    <i class="menu-icon mdi mdi-headset"></i>
                    <span class="menu-title">Complains</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.reports.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.reports.index') }}">
                    <i class="menu-icon mdi mdi-chart-bar"></i>
                    <span class="menu-title">Financial Reports</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.settings.index') }}">
                    <i class="menu-icon mdi mdi-cog"></i>
                    <span class="menu-title">Settings</span>
                </a>
            </li>
        @else
            {{-- User Menu --}}
            <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.dashboard') }}">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('loans.apply') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('loans.apply') }}">
                    <i class="menu-icon mdi mdi-credit-card-plus"></i>
                    <span class="menu-title">Apply for Loan</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('loans.history') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('loans.history') }}">
                    <i class="menu-icon mdi mdi-history"></i>
                    <span class="menu-title">Loan History</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('loans.schedule') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('loans.schedule') }}">
                    <i class="menu-icon mdi mdi-calendar-clock"></i>
                    <span class="menu-title">Repayment Schedule</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('support.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('support.index') }}">
                    <i class="menu-icon mdi mdi-lifebuoy"></i>
                    <span class="menu-title">Contact Support</span>
                </a>
            </li>
        @endif

        <li class="nav-item nav-category">Account</li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link btn btn-link text-start">
                    <i class="menu-icon mdi mdi-logout"></i>
                    <span class="menu-title">Sign Out</span>
                </button>
            </form>
        </li>

    </ul>
</nav>
<!-- partial -->
