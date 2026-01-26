@extends('layouts.modern')

@section('title', 'Repayment History')

@section('content')
    <div class="animate-in">
        {{-- Page Header --}}
        <div class="page-header">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-success-100 dark:bg-success-900/30 flex items-center justify-center">
                    <i data-lucide="history" class="w-6 h-6 text-success-600"></i>
                </div>
                <div>
                    <h1 class="page-title">Repayment History</h1>
                    <p class="page-description">Tracking all loan repayments received from members.</p>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="card-modern overflow-hidden">
            <div
                class="p-6 border-b border-secondary-100 dark:border-secondary-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h3 class="font-bold text-secondary-900 dark:text-white">All Records</h3>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-secondary-400 uppercase tracking-widest">Inflow:</span>
                    <span
                        class="text-sm font-black text-success-600 bg-success-50 dark:bg-success-900/10 px-3 py-1 rounded-full border border-success-100 dark:border-success-900/20">
                        ₦{{ number_format($repayments->sum('amount'), 2) }}
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Loan Details</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Method</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-100 dark:divide-secondary-800">
                        @forelse ($repayments as $repayment)
                            <tr class="hover:bg-secondary-50/50 dark:hover:bg-secondary-800/50 transition-colors">
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center text-[10px] font-bold text-secondary-600">
                                            {{ strtoupper(substr($repayment->loan->user->name ?? '?', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-secondary-900 dark:text-white">
                                                {{ $repayment->loan->user->name ?? 'Unknown Member' }}
                                            </p>
                                            <p class="text-[10px] font-medium text-secondary-500">Member
                                                #{{ 1000 + ($repayment->loan->user_id ?? 0) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-secondary-700 dark:text-secondary-300">Loan
                                            #{{ $repayment->loan_id }}</span>
                                        <span class="text-[10px] font-medium text-secondary-500 truncate max-w-[120px]">
                                            @if ($repayment->remarks)
                                                {{ $repayment->remarks }}
                                            @else
                                                Regular Installment
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-sm font-black text-success-600">
                                        ₦{{ number_format($repayment->amount, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-bold text-secondary-900 dark:text-white">{{ $repayment->payment_date->format('d M, Y') }}</span>
                                        <span
                                            class="text-[10px] text-secondary-500">{{ $repayment->payment_date->diffForHumans() }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="px-2 py-0.5 rounded-lg bg-secondary-100 dark:bg-secondary-800 text-[10px] font-bold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider">
                                        {{ $repayment->payment_method }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.loans.show', $repayment->loan_id) }}"
                                        class="p-2 text-secondary-400 hover:text-primary transition-colors"
                                        title="View Loan">
                                        <i data-lucide="external-link" class="w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-secondary-500 italic">
                                    No repayment records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($repayments->hasPages())
                <div class="p-6 border-t border-secondary-100 dark:border-secondary-800">
                    {{ $repayments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
