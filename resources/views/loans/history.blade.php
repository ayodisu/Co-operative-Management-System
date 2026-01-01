@extends('layouts.main')

@section('title', 'Loan History')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Loan History</h4>
                    <p class="card-description">
                        Track your loan applications and repayment status.
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Loan ID</th>
                                    <th>Total Amount</th>
                                    <th>Repaid</th>
                                    <th>Balance</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Date Applied</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($loans as $loan)
                                    <tr>
                                        <td class="py-1">#{{ $loan->id }}</td>
                                        <td>₦{{ number_format($loan->amount, 2) }}</td>
                                        <td class="text-success">₦{{ number_format($loan->amount_repaid, 2) }}</td>
                                        <td class="text-danger">₦{{ number_format($loan->balance_remaining, 2) }}</td>
                                        <td>{{ $loan->duration_months }} Months</td>
                                        <td>
                                            @php
                                                $badgeClass = match ($loan->status) {
                                                    'approved' => 'badge-success',
                                                    'paid' => 'badge-success',
                                                    'pending' => 'badge-warning',
                                                    'rejected' => 'badge-danger',
                                                    'running' => 'badge-info',
                                                    default => 'badge-secondary',
                                                };
                                            @endphp
                                            <label class="badge {{ $badgeClass }}">{{ ucfirst($loan->status) }}</label>
                                        </td>
                                        <td>{{ $loan->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">You have no loan history yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
