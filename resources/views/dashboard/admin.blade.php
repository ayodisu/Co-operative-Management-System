@extends('layouts.modern')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Dashboard Overview</h1>
                <p class="page-description">Welcome back! Here's what's happening with the cooperative today.</p>
            </div>
            <a href="{{ route('admin.reports.index') }}" class="btn btn-primary">
                <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                View Reports
            </a>
        </div>

        {{-- Primary Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

            {{-- Total Members --}}
            <a href="{{ route('admin.members.index') }}" class="block group">
                <div class="stat-card stat-primary">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Total Members</p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                {{ number_format($totalMembers) }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2">Active cooperative members</p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Society Equity --}}
            <div class="stat-card stat-success">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Society Equity</p>
                        <p class="text-xl font-bold text-secondary-900 dark:text-white">
                            ₦{{ number_format($totalEquity, 2) }}
                        </p>
                        <p class="text-xs text-secondary-400 mt-2">Total member contributions</p>
                    </div>
                    <div class="stat-icon flex-shrink-0">
                        <i data-lucide="landmark" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>

            {{-- Pending Requests --}}
            <a href="{{ route('admin.loans.index') }}" class="block group">
                <div class="stat-card stat-warning">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Pending Requests
                            </p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                {{ $pendingRequestsCount }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2">Awaiting approval</p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="clock" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Support Tickets --}}
            <a href="{{ route('admin.tickets.index') }}" class="block group">
                <div class="stat-card stat-danger">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Support Tickets
                            </p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                {{ $openTicketsCount }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2">Open tickets</p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="headphones" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

        </div>

        {{-- Financial Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            {{-- Loans Disbursed --}}
            <a href="{{ route('admin.loans.index') }}" class="block group">
                <div class="stat-card stat-info">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Loans
                                Disbursed
                            </p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                ₦{{ number_format($totalLoanDisbursed, 2) }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2">Total loans given</p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="banknote" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Total Repayments --}}
            <a href="{{ route('admin.repayments.index') }}" class="block group">
                <div class="stat-card stat-success">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Repayments
                            </p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                ₦{{ number_format($totalRepayments, 2) }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2">Total collected</p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="wallet" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Savings Transactions --}}
            <a href="{{ route('admin.savings.index') }}" class="block group">
                <div class="stat-card stat-primary">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-1">Savings Txns
                            </p>
                            <p class="text-xl font-bold text-secondary-900 dark:text-white">
                                {{ number_format($savingsTransactionsCount) }}
                            </p>
                            <p class="text-xs text-secondary-400 mt-2">Total transactions</p>
                        </div>
                        <div class="stat-icon flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i data-lucide="repeat" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </a>

        </div>

        {{-- Final Section Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Quick Actions --}}
            <div class="card-modern p-6">
                <h3 class="font-semibold text-secondary-900 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="zap" class="w-5 h-5 text-primary"></i>
                    Quick Actions
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.loans.index') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-xl bg-secondary-50 dark:bg-secondary-800 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors group">
                        <div
                            class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <i data-lucide="clipboard-list" class="w-6 h-6 text-amber-600"></i>
                        </div>
                        <span
                            class="text-sm font-medium text-secondary-700 dark:text-secondary-300 group-hover:text-primary text-center">Review
                            Loans</span>
                    </a>

                    <a href="{{ route('admin.members.index') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-xl bg-secondary-50 dark:bg-secondary-800 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors group">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i data-lucide="user-plus" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <span
                            class="text-sm font-medium text-secondary-700 dark:text-secondary-300 group-hover:text-primary text-center">Manage
                            Members</span>
                    </a>

                    <a href="{{ route('admin.savings.index') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-xl bg-secondary-50 dark:bg-secondary-800 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors group">
                        <div
                            class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <i data-lucide="piggy-bank" class="w-6 h-6 text-green-600"></i>
                        </div>
                        <span
                            class="text-sm font-medium text-secondary-700 dark:text-secondary-300 group-hover:text-primary text-center">Savings</span>
                    </a>

                    <a href="{{ route('admin.reports.index') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-xl bg-secondary-50 dark:bg-secondary-800 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors group">
                        <div
                            class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <i data-lucide="file-bar-chart" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <span
                            class="text-sm font-medium text-secondary-700 dark:text-secondary-300 group-hover:text-primary text-center">Reports</span>
                    </a>
                </div>
            </div>

            {{-- System Info --}}
            <div class="card-modern p-6">
                <h3 class="font-semibold text-secondary-900 dark:text-white mb-4 flex items-center gap-2">
                    <i data-lucide="info" class="w-5 h-5 text-primary"></i>
                    System Overview
                </h3>
                <div class="space-y-4">
                    <div
                        class="flex items-center justify-between py-3 border-b border-secondary-100 dark:border-secondary-700">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <p class="font-medium text-secondary-900 dark:text-white">System Admins</p>
                                <p class="text-sm text-secondary-500">{{ $totalAdmins }} active</p>
                            </div>
                        </div>
                        <span class="badge badge-success">Online</span>
                    </div>

                    <div
                        class="flex items-center justify-between py-3 border-b border-secondary-100 dark:border-secondary-700">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                <i data-lucide="database" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-secondary-900 dark:text-white">Database</p>
                                <p class="text-sm text-secondary-500">MySQL</p>
                            </div>
                        </div>
                        <span class="badge badge-success">Connected</span>
                    </div>

                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                <i data-lucide="calendar" class="w-5 h-5 text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-secondary-900 dark:text-white">Interest Calculation</p>
                                <p class="text-sm text-secondary-500">Monthly on 1st</p>
                            </div>
                        </div>
                        <span class="badge badge-primary">Scheduled</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
