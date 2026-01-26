@extends('layouts.modern')

@section('title', 'Financial Reports')

@section('content')
    <div class="animate-in">
        {{-- Page Header --}}
        <div class="page-header">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                    <i data-lucide="bar-chart-3" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h1 class="page-title">Financial Reports</h1>
                    <p class="page-description">Detailed overview of cooperative financial performance.</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="btn btn-secondary btn-sm bg-white dark:bg-secondary-800">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    Print Report
                </button>
            </div>
        </div>

        {{-- Filter Section --}}
        <div
            class="card-modern p-6 mb-8 flex flex-col md:flex-row items-end gap-6 bg-secondary-50/50 dark:bg-secondary-800/30 border-dashed">
            <form action="{{ route('admin.reports.index') }}" method="GET"
                class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                <div>
                    <label for="start_date" class="input-label">Start Date</label>
                    <input type="date" class="input-modern" id="start_date" name="start_date"
                        value="{{ $startDate }}">
                </div>
                <div>
                    <label for="end_date" class="input-label">End Date</label>
                    <input type="date" class="input-modern" id="end_date" name="end_date" value="{{ $endDate }}">
                </div>
            </form>
            <button type="submit" form="filterForm" class="btn btn-primary h-[46px] px-8">
                <i data-lucide="filter" class="w-4 h-4"></i>
                Generate Report
            </button>
            <form id="filterForm" action="{{ route('admin.reports.index') }}" method="GET" class="hidden"></form>
        </div>

        {{-- Top Stats row --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <div class="stat-card border border-secondary-100 dark:border-secondary-800">
                <p class="text-[10px] font-bold uppercase tracking-widest text-secondary-500 mb-2">Loans Disbursed</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-2xl font-black text-secondary-900 dark:text-white">
                        ₦{{ number_format($loansDisbursedAmount, 2) }}</h3>
                    <span
                        class="text-xs font-bold text-success-600 bg-success-50 dark:bg-success-900/20 px-2 py-0.5 rounded-lg border border-success-100 dark:border-success-900/10">{{ $approvedLoans }}
                        Approved</span>
                </div>
                <div class="mt-4 pt-4 border-t border-secondary-50 dark:border-secondary-800">
                    <p class="text-[10px] font-medium text-secondary-400">Total Applications: {{ $totalLoans }}</p>
                </div>
            </div>

            <div class="stat-card border border-secondary-100 dark:border-secondary-800">
                <p class="text-[10px] font-bold uppercase tracking-widest text-secondary-500 mb-2">Repayments Collected</p>
                <h3 class="text-2xl font-black text-primary">₦{{ number_format($repaymentsCollected, 2) }}</h3>
                <div class="mt-4 pt-4 border-t border-secondary-50 dark:border-secondary-800 flex items-center gap-2">
                    <i data-lucide="trending-up" class="w-3 h-3 text-success-500"></i>
                    <p class="text-[10px] font-medium text-success-500">Recovering capital</p>
                </div>
            </div>

            <div class="stat-card border border-secondary-100 dark:border-secondary-800">
                <p class="text-[10px] font-bold uppercase tracking-widest text-secondary-500 mb-2">Member Equity</p>
                <h3 class="text-2xl font-black text-amber-600">₦{{ number_format($totalEquity, 2) }}</h3>
                <div class="mt-4 pt-4 border-t border-secondary-50 dark:border-secondary-800">
                    <p class="text-[10px] font-medium text-secondary-400">Active member contributions</p>
                </div>
            </div>

            <div class="stat-card border border-secondary-100 dark:border-secondary-800">
                <p class="text-[10px] font-bold uppercase tracking-widest text-secondary-500 mb-2">Interest Paid Out</p>
                <h3 class="text-2xl font-black text-blue-600">₦{{ number_format($totalInterest, 2) }}</h3>
                <div class="mt-4 pt-4 border-t border-secondary-50 dark:border-secondary-800">
                    <p class="text-[10px] font-medium text-secondary-400">Total interest credited</p>
                </div>
            </div>
        </div>

        {{-- Detailed Sections --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Loans Section --}}
            <div class="card-modern overflow-hidden">
                <div
                    class="p-6 border-b border-secondary-100 dark:border-secondary-800 bg-secondary-50/50 dark:bg-secondary-800/30">
                    <h3 class="font-bold text-secondary-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="arrow-up-right" class="w-4 h-4 text-success-500"></i>
                        Recent Disbursed Loans
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table-modern text-xs">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Amount</th>
                                <th class="text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary-50 dark:divide-secondary-800">
                            @forelse($recentLoans as $loan)
                                <tr>
                                    <td class="font-bold text-secondary-700 dark:text-secondary-300">
                                        {{ $loan->user->name }}</td>
                                    <td class="font-black text-success-600">₦{{ number_format($loan->amount, 2) }}</td>
                                    <td class="text-right text-secondary-400 font-medium">
                                        {{ $loan->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center p-8 text-secondary-400 italic">No loans found for
                                        this period.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Repayments Section --}}
            <div class="card-modern overflow-hidden">
                <div
                    class="p-6 border-b border-secondary-100 dark:border-secondary-800 bg-secondary-50/50 dark:bg-secondary-800/30">
                    <h3 class="font-bold text-secondary-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="arrow-down-left" class="w-4 h-4 text-primary"></i>
                        Recent Repayments
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table-modern text-xs">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Amount</th>
                                <th class="text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary-50 dark:divide-secondary-800">
                            @forelse($recentRepayments as $repayment)
                                <tr>
                                    <td class="font-bold text-secondary-700 dark:text-secondary-300">
                                        {{ $repayment->loan->user->name ?? 'Unknown' }}</td>
                                    <td class="font-black text-primary">₦{{ number_format($repayment->amount, 2) }}</td>
                                    <td class="text-right text-secondary-400 font-medium">
                                        {{ \Carbon\Carbon::parse($repayment->payment_date)->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center p-8 text-secondary-400 italic">No repayments found
                                        for this period.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
