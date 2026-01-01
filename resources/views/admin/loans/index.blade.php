@extends('layouts.main')

@section('title', 'Pending Loans')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Loan Management</h4>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="pending" aria-selected="true">Pending Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="active-tab" data-toggle="tab" href="#active" role="tab"
                            aria-controls="active" aria-selected="false">Active Loans</a>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="myTabContent">
                    <!-- PENDING LOANS -->
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Amount</th>
                                        <th>Duration</th>
                                        <th>Purpose</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingLoans as $loan)
                                        <tr>
                                            <td>
                                                <strong>{{ $loan->user->name }}</strong><br>
                                                <small>{{ $loan->user->profile->department ?? 'N/A' }}</small>
                                            </td>
                                            <td>₦{{ number_format($loan->amount, 2) }}</td>
                                            <td>{{ $loan->duration_months }} Months</td>
                                            <td><small>{{ Str::limit($loan->purpose, 50) }}</small></td>
                                            <td>
                                                <a href="{{ route('admin.loans.show', $loan->id) }}"
                                                    class="btn btn-info btn-sm">Review</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No pending requests.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ACTIVE LOANS -->
                    <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Total Amount</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($activeLoans as $loan)
                                        <tr>
                                            <td>
                                                <strong>{{ $loan->user->name }}</strong><br>
                                                <small class="text-muted">#{{ $loan->id }}</small>
                                            </td>
                                            <td>₦{{ number_format($loan->amount, 2) }}</td>
                                            <td class="text-warning font-weight-bold">
                                                ₦{{ number_format($loan->balance_remaining, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $loan->status == 'paid' ? 'success' : 'primary' }}">
                                                    {{ ucfirst($loan->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.loans.show', $loan->id) }}"
                                                    class="btn btn-primary btn-sm">Manage</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No active loans found.</td>
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
@endsection

@section('js')
    <!-- Bootstrap JS Helper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
