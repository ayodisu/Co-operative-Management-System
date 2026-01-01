<!-- plugins:css -->
<link rel="stylesheet" href="{{ URL::asset('assets/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/vendors/typicons/typicons.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<!-- endinject -->
<!-- Plugin css for this page -->
<!-- End plugin css for this page -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.png') }}" />
<!-- inject:css -->
<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
<!-- Custom Global Form Styling & Theme Overrides -->
<style>
    /* Theme Color Overrides - Rebranding from Blue to Green #1a7c0f */
    :root {
        --primary: #1a7c0f;
        --primary-dark: #145e0b;
        /* Darker shade for hover */
        --primary-light: #e8f5e9;
        /* Light shade for backgrounds */
    }

    /* Text */
    .text-primary {
        color: var(--primary) !important;
    }

    /* Backgrounds */
    .bg-primary {
        background-color: var(--primary) !important;
    }

    /* Buttons */
    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        color: #fff;
    }

    /* Outline Buttons */
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: #fff;
    }

    /* Navigation/Active States (Adjust selectors based on template structure) */
    .nav-item.active>.nav-link {
        color: var(--primary) !important;
    }

    .nav-item.active>.nav-link i {
        color: var(--primary) !important;
    }

    /* Sidebar Specific Overrides */
    .sidebar .nav .nav-item.active>.nav-link .menu-title,
    .sidebar .nav .nav-item.active>.nav-link i {
        color: var(--primary) !important;
    }

    .sidebar .nav .nav-item:hover>.nav-link .menu-title,
    .sidebar .nav .nav-item:hover>.nav-link i {
        color: var(--primary) !important;
    }

    .sidebar .nav .nav-item .nav-link:hover .menu-title,
    .sidebar .nav .nav-item .nav-link:hover i {
        color: var(--primary) !important;
    }

    /* Unified Form Fields */
    /* Unified Form Fields */
    .form-control,
    select.form-control,
    input.form-control,
    textarea.form-control,
    .dataTables_wrapper .dataTables_filter input,
    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da !important;
        border-radius: 0.375rem !important;
        /* 6px */
        padding: 0.625rem 0.75rem !important;
        height: auto !important;
        min-height: 48px !important;
        /* Slightly increased for better target size */
        font-size: 0.95rem !important;
        font-family: 'Manrope', sans-serif !important;
        color: #495057 !important;
        background-color: #fff !important;
        box-shadow: none;
        /* Remove any pre-existing shadows */
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: var(--primary);
        /* Use new primary color */
        box-shadow: 0 0 0 0.2rem rgba(26, 124, 15, 0.25);
        /* #1a7c0f with opacity */
    }

    /* Textareas need distinct height */
    textarea.form-control {
        min-height: 120px !important;
    }

    /* Labels */
    label,
    .form-control-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #343a40;
        margin-bottom: 0.5rem;
    }

    /* Placeholders */
    .form-control::placeholder {
        color: #adb5bd;
        opacity: 1;
        font-weight: 400;
        font-size: 0.9rem;
    }

    /* Buttons General */
    .btn {
        padding: 0.625rem 1.25rem;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 0.375rem;
        transition: all 0.3s;
    }

    .btn-lg {
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
        min-height: auto;
    }

    /* Card spacing for forms */
    .card-body {
        padding: 2rem;
    }

    /* Input Groups */
    .input-group-text {
        min-height: 45px;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }

    /* Pagination / Active Page */
    .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }
</style>
<!-- endinject -->
