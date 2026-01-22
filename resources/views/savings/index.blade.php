@extends('layouts.main')

@section('title', 'My Savings')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Savings History</h1>
            <a href="{{ route('reports.savings', Auth::user()) }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="mdi mdi-download"></i> Download Statement
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-xl-4 col-md-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Current Balance</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            ₦{{ number_format($profile->total_contributions ?? 0, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Balance After</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at->format('d M, Y') }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match ($transaction->type) {
                                                'deposit' => 'badge-success',
                                                'withdrawal' => 'badge-danger',
                                                'interest' => 'badge-info',
                                                default => 'badge-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($transaction->type) }}</span>
                                    </td>
                                    <td class="font-weight-bold">₦{{ number_format($transaction->amount, 2) }}</td>
                                    <td>₦{{ number_format($transaction->balance_after, 2) }}</td>
                                    <td>{{ $transaction->description ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No transactions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
