@extends('layouts.modern')

@section('title', 'Dashboard')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="page-description">Here's what's happening with your account today.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('reports.savings', Auth::user()) }}" class="btn btn-secondary">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Download Statement
                </a>
                <a href="{{ route('loans.apply') }}" class="btn btn-primary">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Apply for Loan
                </a>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

            {{-- Total Savings --}}
            <a href="{{ route('savings.index') }}" class="block group">
                <div class="stat-card stat-primary">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Total Savings</p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                ₦{{ number_format($profile->total_contributions ?? 0, 2) }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2 flex items-center gap-1">
                                <i data-lucide="trending-up" class="w-3 h-3 text-green-500"></i>
                                Your total contributions
                            </p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="piggy-bank" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Loan Balance --}}
            <a href="{{ route('loans.history') }}" class="block group">
                <div class="stat-card stat-danger">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Loan Balance</p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                ₦{{ number_format($profile->current_loan_balance ?? 0, 2) }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2 flex items-center gap-1">
                                <i data-lucide="credit-card" class="w-3 h-3"></i>
                                Outstanding balance
                            </p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="banknote" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Monthly Contribution --}}
            <div class="stat-card stat-success">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Monthly Deduction</p>
                        <p class="text-xl font-bold text-secondary-900 dark:text-white">
                            ₦{{ number_format($profile->monthly_contribution ?? 0, 2) }}
                        </p>
                        <p class="text-xs text-secondary-400 mt-2 flex items-center gap-1">
                            <i data-lucide="calendar" class="w-3 h-3"></i>
                            Auto-deducted monthly
                        </p>
                    </div>
                    <div class="stat-icon flex-shrink-0">
                        <i data-lucide="calendar-check" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>

            {{-- Pending Requests --}}
            <a href="{{ route('loans.history') }}" class="block group">
                <div class="stat-card stat-warning">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Pending Requests
                            </p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                {{ $pendingLoansCount ?? 0 }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2 flex items-center gap-1">
                                <i data-lucide="clock" class="w-3 h-3"></i>
                                Awaiting approval
                            </p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="hourglass" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            {{-- Quick Actions Card --}}
            <div class="card-modern p-6">
                <h3 class="font-semibold text-secondary-900 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="zap" class="w-5 h-5 text-primary"></i>
                    Quick Actions
                </h3>
                <div class="space-y-3">
                    <a href="{{ route('loans.apply') }}"
                        class="flex items-center gap-3 p-3 rounded-xl bg-secondary-50 dark:bg-secondary-800 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors group">
                        <div
                            class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <i data-lucide="plus-circle" class="w-5 h-5 text-primary"></i>
                        </div>
                        <div class="flex-1">
                            <p
                                class="font-medium text-secondary-900 dark:text-white group-hover:text-primary transition-colors">
                                Apply for Loan</p>
                            <p class="text-xs text-secondary-500">Submit a new loan application</p>
                        </div>
                        <i data-lucide="chevron-right"
                            class="w-4 h-4 text-secondary-400 group-hover:text-primary transition-colors"></i>
                    </a>

                    <a href="{{ route('savings.index') }}"
                        class="flex items-center gap-3 p-3 rounded-xl bg-secondary-50 dark:bg-secondary-800 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors group">
                        <div
                            class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <i data-lucide="wallet" class="w-5 h-5 text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <p
                                class="font-medium text-secondary-900 dark:text-white group-hover:text-primary transition-colors">
                                View Savings</p>
                            <p class="text-xs text-secondary-500">Check your savings history</p>
                        </div>
                        <i data-lucide="chevron-right"
                            class="w-4 h-4 text-secondary-400 group-hover:text-primary transition-colors"></i>
                    </a>

                    <a href="{{ route('support.create') }}"
                        class="flex items-center gap-3 p-3 rounded-xl bg-secondary-50 dark:bg-secondary-800 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors group">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i data-lucide="headphones" class="w-5 h-5 text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <p
                                class="font-medium text-secondary-900 dark:text-white group-hover:text-primary transition-colors">
                                Get Support</p>
                            <p class="text-xs text-secondary-500">Contact our support team</p>
                        </div>
                        <i data-lucide="chevron-right"
                            class="w-4 h-4 text-secondary-400 group-hover:text-primary transition-colors"></i>
                    </a>
                </div>
            </div>

            {{-- Loan Status Card --}}
            <div class="card-modern p-6 lg:col-span-2">
                <h3 class="font-semibold text-secondary-900 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="activity" class="w-5 h-5 text-primary"></i>
                    Loan Overview
                </h3>

                @if ($activeLoansCount > 0)
                    <div class="flex items-center gap-6">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-secondary-600 dark:text-secondary-400">Repayment Progress</span>
                                <span class="text-sm font-medium text-secondary-900 dark:text-white">
                                    {{ $profile->current_loan_balance > 0 ? round((1 - $profile->current_loan_balance / max($profile->total_loan_amount ?? 1, 1)) * 100) : 100 }}%
                                </span>
                            </div>
                            <div class="w-full bg-secondary-200 dark:bg-secondary-700 rounded-full h-3">
                                <div class="bg-gradient-to-r from-primary-400 to-primary-600 h-3 rounded-full transition-all duration-500"
                                    style="width: {{ $profile->current_loan_balance > 0 ? round((1 - $profile->current_loan_balance / max($profile->total_loan_amount ?? 1, 1)) * 100) : 100 }}%">
                                </div>
                            </div>
                            <div class="flex justify-between mt-3 text-sm">
                                <div>
                                    <p class="text-secondary-500 dark:text-secondary-400">Active Loans</p>
                                    <p class="font-semibold text-secondary-900 dark:text-white">{{ $activeLoansCount }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-secondary-500 dark:text-secondary-400">Remaining</p>
                                    <p class="font-semibold text-secondary-900 dark:text-white">
                                        ₦{{ number_format($profile->current_loan_balance ?? 0, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-state py-8">
                        <div
                            class="w-16 h-16 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center mb-4">
                            <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                        </div>
                        <p class="empty-state-title">No Active Loans</p>
                        <p class="empty-state-description">You currently have no outstanding loans. Apply for a loan when
                            you need financial assistance.</p>
                        <a href="{{ route('loans.apply') }}" class="btn btn-primary mt-4">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Apply Now
                        </a>
                    </div>
                @endif
            </div>

        </div>

    </div>
@endsection
