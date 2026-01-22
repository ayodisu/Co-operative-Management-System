@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-4 text-gray-800">Savings Transactions</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">All Transactions</h6>
                        <form action="" method="GET" class="form-inline">
                            <select name="type" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                                <option value="">All Types</option>
                                <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Deposits</option>
                                <option value="withdrawal" {{ request('type') == 'withdrawal' ? 'selected' : '' }}>Withdrawals</option>
                                <option value="interest" {{ request('type') == 'interest' ? 'selected' : '' }}>Interest</option>
                            </select>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Member</th>
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
                                            <td>{{ $transaction->user->name ?? 'Unknown' }}</td>
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
                                            <td colspan="6" class="text-center">No savings transactions recorded yet.</td>
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
        </div>
    </div>
@endsection
