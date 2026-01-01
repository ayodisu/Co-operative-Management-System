@extends('layouts.main')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Admin Dashboard Overview</h1>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('admin.members.index') }}" style="text-decoration: none;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-account-group text-primary" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Members</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalMembers) }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('admin.members.index') }}" style="text-decoration: none;">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-shield-account text-secondary" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">System Admins</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalAdmins) }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('admin.loans.index') }}" style="text-decoration: none;">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-clock-alert-outline text-warning" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingRequestsCount }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('admin.loans.index') }}" style="text-decoration: none;">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-bank text-info" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Society Equity</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₦{{ number_format($totalEquity, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('admin.loans.index') }}" style="text-decoration: none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-currency-ngn text-success" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Loans Disbursed
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ₦{{ number_format($totalLoanDisbursed, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('admin.tickets.index') }}" style="text-decoration: none;">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-lifebuoy text-danger" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Support Tickets</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $openTicketsCount }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
