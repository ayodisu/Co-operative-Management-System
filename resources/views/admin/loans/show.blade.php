@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Loan Details #{{ $loan->id }}</h1>
            <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- Loan Overview Cards -->
        <div class="row">
            <!-- Applicant Info -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Applicant</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $loan->user->name }}</div>
                                <p class="text-muted small mb-0">{{ $loan->user->email }}</p>
                            </div>
                            <div class="col-auto">
                                <i class="mdi mdi-account fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loan Amount -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Loan Amount
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₦{{ number_format($loan->amount, 2) }}
                                </div>
                                <div class="small text-muted">Duration: {{ $loan->duration_months }} months</div>
                            </div>
                            <div class="col-auto">
                                <i class="mdi mdi-cash-multiple fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Balance Remaning -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Current Loan Balance
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ₦{{ number_format($loan->balance_remaining, 2) }}</div>
                                <div class="progress progress-sm mt-2">
                                    @php
                                        $percent = $loan->amount > 0 ? ($loan->amount_repaid / $loan->amount) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="mdi mdi-chart-pie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Actions & Form -->
            <div class="col-lg-5 mb-4">
                <!-- Loan Status Actions -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Loan Status</h6>
                    </div>
                    <div class="card-body">
                        <p>Current Status:
                            <span
                                class="badge badge-{{ $loan->status == 'approved' || $loan->status == 'paid' ? 'success' : ($loan->status == 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </p>
                        @if ($loan->status == 'pending')
                            <hr>
                            <form action="{{ route('admin.loans.update', $loan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Admin Remark</label>
                                    <textarea name="admin_remark" class="form-control" rows="2"></textarea>
                                </div>
                                <button name="status" value="approved" class="btn btn-primary btn-block text-white">Approve
                                    Loan</button>
                                <button name="status" value="rejected" class="btn btn-danger btn-block text-white">Reject
                                    Loan</button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Record Repayment Form (Only for Approved/Running loans) -->
                @if ($loan->status == 'approved' && $loan->balance_remaining > 0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Record Repayment</h6>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.repayments.store', $loan->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Amount (₦)</label>
                                    <input type="number" step="0.01" name="amount" class="form-control"
                                        max="{{ $loan->balance_remaining }}" required>
                                    <small class="text-muted">Max: {{ number_format($loan->balance_remaining, 2) }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Payment Date</label>
                                    <input type="date" name="payment_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Method</label>
                                    <select name="payment_method" class="form-control">
                                        <option>Bank Transfer</option>
                                        <option>Cash</option>
                                        <option>Direct Debit</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Optional notes">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block text-white">Submit
                                    Repayment</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Repayment History -->
            <!-- Repayment History -->
            <div class="col-lg-7 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Repayment History</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-sm text-muted mb-3">
                            This history shows all repayments made specifically for <strong>Loan
                                #{{ $loan->id }}</strong>.
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($loan->repayments as $repayment)
                                        <tr>
                                            <td>{{ $repayment->payment_date->format('d M, Y') }}</td>
                                            <td class="text-success font-weight-bold">
                                                ₦{{ number_format($repayment->amount, 2) }}</td>
                                            <td>{{ $repayment->payment_method }}</td>
                                            <td>{{ $repayment->remarks ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                No repayments recorded for this loan yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                    <!-- Totals Row -->
                                    @if ($loan->repayments->count() > 0)
                                        <tr class="font-weight-bold bg-light">
                                            <td class="text-right">Total Repaid:</td>
                                            <td class="text-success">₦{{ number_format($loan->amount_repaid, 2) }}</td>
                                            <td colspan="2"></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
