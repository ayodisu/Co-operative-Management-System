@extends('layouts.main')

@section('title', 'Financial Reports')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
                    </ol>
                </nav>
            </div>

            <!-- Filter Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.reports.index') }}" method="GET" class="row align-items-center">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ $startDate }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ $endDate }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end mt-3 mt-md-0">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="mdi mdi-filter"></i> Filter Results
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Statistics -->
            <div class="row">
                <!-- Loans Disbursed -->
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-cash-multiple text-gray-300" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1 single-line">
                                    Loans Disbursed
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 single-line">
                                    ₦{{ number_format($loansDisbursedAmount, 2) }}
                                </div>
                                <small class="text-muted">{{ $approvedLoans }} Approved / {{ $totalLoans }}
                                    Applications</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Repayments Collected -->
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-bank-transfer text-gray-300" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 single-line">
                                    Repayments
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 single-line">
                                    ₦{{ number_format($repaymentsCollected, 2) }}
                                </div>
                                <small class="text-muted">Collected in Period</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Equity (Snapshot) -->
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body card-row">
                            <i class="mdi mdi-safe text-gray-300" style="font-size: 2rem;"></i>
                            <div>
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 single-line">
                                    Member Equity
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 single-line">
                                    ₦{{ number_format($totalEquity, 2) }}
                                </div>
                                <small class="text-muted">Total Active Contributions</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Tables -->
            <div class="row mt-4">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Disbursed Loans</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentLoans as $loan)
                                            <tr>
                                                <td>{{ $loan->user->name }}</td>
                                                <td class="text-success">₦{{ number_format($loan->amount, 2) }}</td>
                                                <td>{{ $loan->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No loans found in this
                                                    period.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Repayments</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Loan User</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentRepayments as $repayment)
                                            <tr>
                                                <td>{{ $repayment->loan->user->name ?? 'Unknown' }}</td>
                                                <td class="text-primary">₦{{ number_format($repayment->amount, 2) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($repayment->payment_date)->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No repayments found in
                                                    this period.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
