@extends('layouts.modern')

@section('title', 'My Savings')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">My Savings</h1>
                <p class="page-description">Track your savings contributions and transactions.</p>
            </div>
            <a href="{{ route('reports.savings', Auth::user()) }}" class="btn btn-primary">
                <i data-lucide="download" class="w-4 h-4"></i>
                Download Statement
            </a>
        </div>

        {{-- Balance Card --}}
        <div class="card-modern p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                        <i data-lucide="piggy-bank" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">Current Balance</p>
                        <p class="text-3xl font-bold text-secondary-900 dark:text-white">
                            ₦{{ number_format($balance, 2) }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="text-center px-6 py-3 bg-green-50 dark:bg-green-900/20 rounded-xl">
                        <p class="text-xs text-green-600 dark:text-green-400 font-medium">Total Deposits</p>
                        <p class="text-lg font-bold text-green-700 dark:text-green-300">
                            ₦{{ number_format($transactions->where('type', 'deposit')->sum('amount'), 2) }}
                        </p>
                    </div>
                    <div class="text-center px-6 py-3 bg-red-50 dark:bg-red-900/20 rounded-xl">
                        <p class="text-xs text-red-600 dark:text-red-400 font-medium">Total Withdrawals</p>
                        <p class="text-lg font-bold text-red-700 dark:text-red-300">
                            ₦{{ number_format($transactions->where('type', 'withdrawal')->sum('amount'), 2) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transactions Table --}}
        <div class="card-modern overflow-hidden">
            <div class="p-6 border-b border-secondary-100 dark:border-secondary-700">
                <h3 class="font-semibold text-secondary-900 dark:text-white flex items-center gap-2">
                    <i data-lucide="list" class="w-5 h-5 text-primary"></i>
                    Transaction History
                </h3>
            </div>

            @if ($transactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                                <th class="text-right">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $txn)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="calendar" class="w-4 h-4 text-secondary-400"></i>
                                            {{ $txn->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($txn->type === 'deposit')
                                            <span class="badge badge-success">
                                                <i data-lucide="arrow-down-left" class="w-3 h-3 mr-1"></i>
                                                Deposit
                                            </span>
                                        @elseif($txn->type === 'withdrawal')
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
                                    <td class="text-secondary-600 dark:text-secondary-400">
                                        {{ $txn->description ?? '-' }}
                                    </td>
                                    <td
                                        class="text-right font-semibold {{ $txn->type === 'withdrawal' ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $txn->type === 'withdrawal' ? '-' : '+' }}₦{{ number_format($txn->amount, 2) }}
                                    </td>
                                    <td class="text-right font-medium text-secondary-900 dark:text-white">
                                        ₦{{ number_format($txn->balance_after, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($transactions->hasPages())
                    <div class="p-4 border-t border-secondary-100 dark:border-secondary-700">
                        {{ $transactions->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state py-12">
                    <div
                        class="w-16 h-16 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center mb-4">
                        <i data-lucide="inbox" class="w-8 h-8 text-secondary-400"></i>
                    </div>
                    <p class="empty-state-title">No Transactions Yet</p>
                    <p class="empty-state-description">Your savings transaction history will appear here once you make your
                        first contribution.</p>
                </div>
            @endif
        </div>

    </div>
@endsection
