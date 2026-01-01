<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') | Audit </title>
    @include('layouts.layout_css')
    @yield('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container-scroller">

        @include('layouts.topbar')

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            {{-- @if (Auth::check())
            @if (Auth::user()->role == 'admin')
                @include('layouts.admin_sidebar')
            @elseif(Auth::user()->role == 'user')
                @include('layouts.user_sidebar')
            @else
                @include('layouts.default_sidebar')
            @endif
        @endif --}}

            @include('layouts.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('content')

                </div>
                <!-- content-wrapper ends -->
                @include('layouts.footer')

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    @include('layouts.layout_js')
    @yield('js')

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
    <style>
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        body.dark-mode .navbar,
        body.dark-mode .sidebar,
        body.dark-mode .card,
        body.dark-mode .footer,
        body.dark-mode .content-wrapper {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        body.dark-mode .navbar .navbar-brand-wrapper,
        body.dark-mode .navbar .navbar-menu-wrapper {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        /* Navbar icons (bell, dark mode toggle, etc.) */
        body.dark-mode .navbar .nav-link,
        body.dark-mode .navbar .nav-link i,
        body.dark-mode .navbar .nav-link .mdi,
        body.dark-mode .navbar .icon-bell,
        body.dark-mode .navbar .mdi-brightness-6,
        body.dark-mode .navbar .navbar-nav .nav-item .nav-link {
            color: #e0e0e0 !important;
        }

        body.dark-mode .navbar .nav-link:hover,
        body.dark-mode .navbar .nav-link:hover i,
        body.dark-mode .navbar .navbar-nav .nav-item .nav-link:hover {
            color: #ffffff !important;
        }

        body.dark-mode .text-black {
            color: #e0e0e0 !important;
        }

        body.dark-mode .table {
            color: #e0e0e0 !important;
            background-color: #1e1e1e !important;
        }

        /* Comprehensive form controls */
        body.dark-mode .form-control,
        body.dark-mode input[type="text"],
        body.dark-mode input[type="email"],
        body.dark-mode input[type="password"],
        body.dark-mode input[type="number"],
        body.dark-mode input[type="date"],
        body.dark-mode input[type="tel"],
        body.dark-mode input[type="url"],
        body.dark-mode input[type="search"],
        body.dark-mode textarea,
        body.dark-mode select,
        body.dark-mode .form-select {
            background-color: #2c2c2c !important;
            color: #e0e0e0 !important;
            border-color: #555 !important;
        }

        body.dark-mode .form-control:focus,
        body.dark-mode input:focus,
        body.dark-mode textarea:focus,
        body.dark-mode select:focus,
        body.dark-mode .form-select:focus {
            background-color: #333 !important;
            color: #ffffff !important;
            border-color: #7da0fa !important;
            box-shadow: 0 0 0 0.2rem rgba(125, 160, 250, 0.25) !important;
        }

        body.dark-mode .form-control::placeholder,
        body.dark-mode input::placeholder,
        body.dark-mode textarea::placeholder {
            color: #888 !important;
        }

        body.dark-mode label,
        body.dark-mode .form-label {
            color: #b0b0b0 !important;
        }

        /* Select dropdown options */
        body.dark-mode select option {
            background-color: #2c2c2c;
            color: #e0e0e0;
        }

        body.dark-mode .dropdown-menu {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        body.dark-mode .dropdown-item {
            color: #e0e0e0;
        }

        body.dark-mode .dropdown-item:hover {
            background-color: #333;
        }

        /* Card headers and backgrounds */
        body.dark-mode .card-header,
        body.dark-mode .card-footer,
        body.dark-mode .bg-white {
            background-color: #1e1e1e !important;
            color: #e0e0e0;
        }

        body.dark-mode .bg-light {
            background-color: #2c2c2c !important;
        }

        /* Card title and text colors */
        body.dark-mode .card-title,
        body.dark-mode .text-gray-800,
        body.dark-mode .text-dark,
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6 {
            color: #e0e0e0 !important;
        }

        body.dark-mode .text-muted {
            color: #a0a0a0 !important;
        }

        /* Make icons visible in dark mode - brighten them */
        body.dark-mode .mdi.text-primary,
        body.dark-mode .text-primary {
            color: #7da0fa !important;
        }

        body.dark-mode .mdi.text-secondary,
        body.dark-mode .text-secondary {
            color: #80d4f7 !important;
        }

        body.dark-mode .mdi.text-success,
        body.dark-mode .text-success {
            color: #5edca0 !important;
        }

        body.dark-mode .mdi.text-info,
        body.dark-mode .text-info {
            color: #7dd3fc !important;
        }

        body.dark-mode .mdi.text-warning,
        body.dark-mode .text-warning {
            color: #fcd34d !important;
        }

        body.dark-mode .mdi.text-danger,
        body.dark-mode .text-danger {
            color: #fca5a5 !important;
        }

        /* Badge visibility in dark mode */
        body.dark-mode .badge-primary {
            background-color: #3b5fdf !important;
            color: #ffffff !important;
        }

        body.dark-mode .badge-warning {
            background-color: #f59e0b !important;
            color: #1e1e1e !important;
        }

        body.dark-mode .badge-success {
            background-color: #10b981 !important;
            color: #ffffff !important;
        }

        body.dark-mode .badge-danger {
            background-color: #ef4444 !important;
            color: #ffffff !important;
        }

        body.dark-mode .badge-info {
            background-color: #06b6d4 !important;
            color: #ffffff !important;
        }

        /* Breadcrumbs */
        body.dark-mode .breadcrumb {
            background-color: transparent;
        }

        body.dark-mode .breadcrumb-item a {
            color: #7da0fa;
        }

        body.dark-mode .breadcrumb-item.active {
            color: #a0a0a0;
        }

        /* Alerts */
        body.dark-mode .alert-success {
            background-color: #065f46;
            color: #a7f3d0;
            border-color: #10b981;
        }

        /* Welcome text area */
        body.dark-mode .welcome-text,
        body.dark-mode .welcome-sub-text {
            color: #e0e0e0 !important;
        }

        /* Sidebar Navigation - matching theme specificity */
        body.dark-mode .sidebar .nav .nav-item .nav-link {
            color: #b0b0b0 !important;
        }

        body.dark-mode .sidebar .nav:not(.sub-menu)>.nav-item:hover>.nav-link,
        body.dark-mode .sidebar .nav .nav-item .nav-link:hover {
            color: #7da0fa !important;
            background: rgba(125, 160, 250, 0.1) !important;
        }

        body.dark-mode .sidebar .nav:not(.sub-menu)>.nav-item.active>.nav-link {
            color: #7da0fa !important;
            background: rgba(125, 160, 250, 0.15) !important;
        }

        body.dark-mode .sidebar .nav .nav-item .nav-link .menu-icon,
        body.dark-mode .sidebar .nav .nav-item .nav-link i {
            color: #b0b0b0 !important;
        }

        body.dark-mode .sidebar .nav:not(.sub-menu)>.nav-item:hover>.nav-link .menu-icon,
        body.dark-mode .sidebar .nav:not(.sub-menu)>.nav-item:hover>.nav-link i,
        body.dark-mode .sidebar .nav .nav-item:hover .nav-link .menu-icon,
        body.dark-mode .sidebar .nav .nav-item:hover .nav-link i {
            color: #7da0fa !important;
        }

        body.dark-mode .sidebar .nav:not(.sub-menu)>.nav-item.active>.nav-link .menu-icon,
        body.dark-mode .sidebar .nav:not(.sub-menu)>.nav-item.active>.nav-link i {
            color: #7da0fa !important;
        }

        body.dark-mode .sidebar .nav .nav-item .menu-title {
            color: inherit !important;
        }

        body.dark-mode .sidebar .nav .nav-item.nav-category {
            color: #808080 !important;
        }

        /* Card body */
        body.dark-mode .card-body {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        /* Message bubbles in support tickets - user messages (white bg) */
        body.dark-mode .card.bg-white {
            background-color: #2a2a2a !important;
            color: #e0e0e0 !important;
        }

        body.dark-mode .card.bg-white .card-body {
            background-color: #2a2a2a !important;
            color: #e0e0e0 !important;
        }

        body.dark-mode .card.bg-white .card-body p {
            color: #e0e0e0 !important;
        }

        /* Table improvements */
        body.dark-mode .table thead th {
            color: #b0b0b0 !important;
            border-color: #444 !important;
            background-color: #252525 !important;
        }

        body.dark-mode .table tbody td {
            color: #e0e0e0 !important;
            border-color: #444 !important;
            background-color: #1e1e1e !important;
        }

        body.dark-mode .table tbody tr {
            background-color: #1e1e1e !important;
        }

        body.dark-mode .table-striped tbody tr:nth-of-type(odd) {
            background-color: #252525 !important;
        }

        body.dark-mode .table-hover tbody tr:hover {
            background-color: #333 !important;
        }

        body.dark-mode .table-responsive {
            background-color: #1e1e1e !important;
        }

        /* DataTables plugin compatibility */
        body.dark-mode .dataTables_wrapper,
        body.dark-mode .dataTables_length,
        body.dark-mode .dataTables_filter,
        body.dark-mode .dataTables_info,
        body.dark-mode .dataTables_paginate {
            color: #b0b0b0 !important;
        }

        body.dark-mode .dataTables_wrapper .dataTables_length select,
        body.dark-mode .dataTables_wrapper .dataTables_filter input {
            background-color: #2c2c2c !important;
            color: #e0e0e0 !important;
            border-color: #555 !important;
        }

        body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #b0b0b0 !important;
        }

        body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #333 !important;
            color: #ffffff !important;
            border-color: #555 !important;
        }

        /* Card descriptions */
        body.dark-mode .card-description {
            color: #a0a0a0 !important;
        }

        /* Links */
        body.dark-mode a:not(.btn):not(.nav-link):not(.dropdown-item) {
            color: #7da0fa;
        }

        /* Button outlines */
        body.dark-mode .btn-outline-primary {
            color: #7da0fa;
            border-color: #7da0fa;
        }

        body.dark-mode .btn-outline-primary:hover {
            background-color: #7da0fa;
            color: #1e1e1e;
        }

        /* Ticket Status Badges - Global */
        .ticket-badge-open,
        .ticket-badge-answered,
        .ticket-badge-closed,
        .ticket-badge-default {
            color: #ffffff !important;
            font-weight: 500;
        }

        .ticket-badge-open {
            background-color: #f59e0b !important;
        }

        .ticket-badge-answered {
            background-color: #3b5fdf !important;
        }

        .ticket-badge-closed {
            background-color: #10b981 !important;
        }

        .ticket-badge-default {
            background-color: #6b7280 !important;
        }

        /* Sidebar active state background override for dark mode */
        body.dark-mode .sidebar .nav .nav-item.active {
            background: rgba(125, 160, 250, 0.15) !important;
        }

        body.dark-mode .sidebar .nav .nav-item:hover {
            background: rgba(125, 160, 250, 0.1) !important;
        }

        /* Nav Tabs in Dark Mode */
        body.dark-mode .nav-tabs {
            border-bottom-color: #444 !important;
        }

        body.dark-mode .nav-tabs .nav-link {
            background: #2c2c2c !important;
            color: #e0e0e0 !important;
            border-color: #444 !important;
        }

        body.dark-mode .nav-tabs .nav-link:hover {
            border-color: #555 !important;
            background-color: #333 !important;
        }

        body.dark-mode .nav-tabs .nav-link.active {
            background-color: #1e1e1e !important;
            color: #7da0fa !important;
            border-color: #444 !important;
            border-bottom-color: #1e1e1e !important;
        }
    </style>
</body>

</html>
