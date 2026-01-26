@extends('layouts.modern')

@section('title', 'Loan History')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Loan History</h1>
                <p class="page-description">View all your loan applications and their current status.</p>
            </div>
            <a href="{{ route('loans.apply') }}" class="btn btn-primary">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Apply for Loan
            </a>
        </div>

        {{-- Loans List --}}
        <div class="space-y-4">
            @forelse($loans as $loan)
                <div class="card-modern p-6 hover:shadow-card-hover transition-shadow">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">

                        {{-- Loan Info --}}
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                            @if ($loan->status === 'approved' || $loan->status === 'running') bg-green-100 dark:bg-green-900/30
                            @elseif($loan->status === 'pending') bg-amber-100 dark:bg-amber-900/30
                            @elseif($loan->status === 'repaid') bg-blue-100 dark:bg-blue-900/30
                            @else bg-red-100 dark:bg-red-900/30 @endif">
                                <i data-lucide="banknote"
                                    class="w-6 h-6
                                @if ($loan->status === 'approved' || $loan->status === 'running') text-green-600
                                @elseif($loan->status === 'pending') text-amber-600
                                @elseif($loan->status === 'repaid') text-blue-600
                                @else text-red-600 @endif"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="font-semibold text-secondary-900 dark:text-white">
                                        ₦{{ number_format($loan->amount, 2) }}
                                    </h3>
                                    @if ($loan->status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($loan->status === 'approved' || $loan->status === 'running')
                                        <span class="badge badge-success">Running</span>
                                    @elseif($loan->status === 'repaid')
                                        <span class="badge badge-info">Repaid</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($loan->status) }}</span>
                                    @endif
                                </div>
                                <p class="text-sm text-secondary-500 dark:text-secondary-400">
                                    Applied: {{ $loan->created_at->format('M d, Y') }} •
                                    Duration: {{ $loan->duration_months }} months
                                </p>
                                <p class="text-sm text-secondary-600 dark:text-secondary-300 mt-1">
                                    {{ Str::limit($loan->purpose, 60) }}
                                </p>
                            </div>
                        </div>

                        {{-- Loan Stats & Actions --}}
                        <div class="flex items-center gap-6">
                            @if (in_array($loan->status, ['approved', 'running']))
                                <div class="text-right">
                                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Remaining</p>
                                    <p class="font-bold text-secondary-900 dark:text-white">
                                        ₦{{ number_format($loan->balance_remaining, 2) }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Repaid</p>
                                    <p class="font-bold text-green-600">
                                        ₦{{ number_format($loan->amount_repaid, 2) }}
                                    </p>
                                </div>
                            @endif
                            <a href="{{ route('reports.loan', $loan) }}" class="btn btn-secondary btn-sm">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                Statement
                            </a>
                        </div>
                    </div>

                    {{-- Progress Bar for Running Loans --}}
                    @if (in_array($loan->status, ['approved', 'running']) && $loan->amount > 0)
                        <div class="mt-4 pt-4 border-t border-secondary-100 dark:border-secondary-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-secondary-500 dark:text-secondary-400">Repayment Progress</span>
                                <span class="text-sm font-medium text-secondary-900 dark:text-white">
                                    {{ round(($loan->amount_repaid / $loan->amount) * 100) }}%
                                </span>
                            </div>
                            <div class="w-full bg-secondary-200 dark:bg-secondary-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-primary-400 to-primary-600 h-2 rounded-full transition-all duration-500"
                                    style="width: {{ ($loan->amount_repaid / $loan->amount) * 100 }}%"></div>
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="card-modern">
                    <div class="empty-state py-12">
                        <div
                            class="w-16 h-16 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center mb-4">
                            <i data-lucide="file-x" class="w-8 h-8 text-secondary-400"></i>
                        </div>
                        <p class="empty-state-title">No Loan History</p>
                        <p class="empty-state-description">You haven't applied for any loans yet. Apply for a loan when you
                            need financial assistance.</p>
                        <a href="{{ route('loans.apply') }}" class="btn btn-primary mt-4">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Apply Now
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
@endsection
