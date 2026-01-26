@extends('layouts.modern')

@section('title', 'Savings Transactions')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Savings Transactions</h1>
                <p class="page-description">View and manage all member savings transactions.</p>
            </div>
            <form action="" method="GET" class="flex items-center gap-3">
                <select name="type" class="input-modern py-2.5 w-40" onchange="this.form.submit()">
                    <option value="">All Types</option>
                    <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Deposits</option>
                    <option value="withdrawal" {{ request('type') == 'withdrawal' ? 'selected' : '' }}>Withdrawals</option>
                    <option value="interest" {{ request('type') == 'interest' ? 'selected' : '' }}>Interest</option>
                </select>
            </form>
        </div>

        {{-- Transactions Table --}}
        <div class="card-modern overflow-hidden">
            @if ($transactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Member</th>
                                <th>Type</th>
                                <th class="text-right">Amount</th>
                                <th class="text-right">Balance After</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="calendar" class="w-4 h-4 text-secondary-400"></i>
                                            {{ $transaction->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.members.show', $transaction->user_id) }}"
                                            class="flex items-center gap-3 hover:text-primary transition-colors">
                                            <div class="avatar avatar-sm">
                                                {{ substr($transaction->user->name ?? '?', 0, 1) }}</div>
                                            <span class="font-medium">{{ $transaction->user->name ?? 'Unknown' }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($transaction->type === 'deposit')
                                            <span class="badge badge-success">
                                                <i data-lucide="arrow-down-left" class="w-3 h-3 mr-1"></i>
                                                Deposit
                                            </span>
                                        @elseif($transaction->type === 'withdrawal')
                                            <span class="badge badge-danger">
                                                <i data-lucide="arrow-up-right" class="w-3 h-3 mr-1"></i>
                                                Withdrawal
                                            </span>
                                        @else
                                            <span class="badge badge-info">
                                                <i data-lucide="percent" class="w-3 h-3 mr-1"></i>
                                                Interest
                                            </span>
                                        @endif
                                    </td>
                                    <td
                                        class="text-right font-bold {{ $transaction->type === 'withdrawal' ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $transaction->type === 'withdrawal' ? '-' : '+' }}₦{{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="text-right font-medium text-secondary-900 dark:text-white">
                                        ₦{{ number_format($transaction->balance_after, 2) }}
                                    </td>
                                    <td class="text-secondary-500 dark:text-secondary-400 max-w-[200px] truncate">
                                        {{ $transaction->description ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($transactions->hasPages())
                    <div class="p-4 border-t border-secondary-100 dark:border-secondary-700">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state py-12">
                    <div
                        class="w-16 h-16 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center mb-4">
                        <i data-lucide="inbox" class="w-8 h-8 text-secondary-400"></i>
                    </div>
                    <p class="empty-state-title">No Transactions Found</p>
                    <p class="empty-state-description">No savings transactions match your filter criteria.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
