@extends('layouts.main')

@section('title', 'User Dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome, {{ Auth::user()->name ?? 'User' }}</h1>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body card-row">
                    <i class="mdi mdi-piggy-bank text-gray-300" style="font-size: 2rem;"></i>
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 single-line">
                            Total Contributions
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 single-line">
                            ₦{{ number_format($profile->total_contributions ?? 0, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body card-row">
                    <i class="mdi mdi-cash-multiple text-gray-300" style="font-size: 2rem;"></i>
                    <div>
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1 single-line">
                            Loan Balance
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 single-line">
                            ₦{{ number_format($profile->current_loan_balance ?? 0, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body card-row">
                    <i class="mdi mdi-calendar-check text-gray-300" style="font-size: 2rem;"></i>
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1 single-line">
                            Monthly Deduction
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 single-line">
                            ₦{{ number_format($profile->monthly_contribution ?? 0, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body card-row">
                    <i class="mdi mdi-clock-outline text-gray-300" style="font-size: 2rem;"></i>
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1 single-line">
                            Pending Requests
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 single-line">
                            {{ $pendingLoansCount ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection