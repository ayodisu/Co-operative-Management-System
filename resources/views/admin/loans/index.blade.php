@extends('layouts.modern')

@section('title', 'Loan Management')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Loan Management</h1>
                <p class="page-description">Review and manage member loan applications.</p>
            </div>
        </div>

        {{-- Tabs --}}
        <div x-data="{ activeTab: 'pending' }" class="space-y-6">
            <div class="flex gap-2 border-b border-secondary-200 dark:border-secondary-700">
                <button @click="activeTab = 'pending'"
                    :class="activeTab === 'pending' ? 'border-primary text-primary' :
                        'border-transparent text-secondary-500 hover:text-secondary-700'"
                    class="px-4 py-3 font-medium text-sm border-b-2 transition-colors">
                    Pending Requests
                    @if ($pendingLoans->count() > 0)
                        <span
                            class="ml-2 px-2 py-0.5 text-xs rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400">
                            {{ $pendingLoans->count() }}
                        </span>
                    @endif
                </button>
                <button @click="activeTab = 'active'"
                    :class="activeTab === 'active' ? 'border-primary text-primary' :
                        'border-transparent text-secondary-500 hover:text-secondary-700'"
                    class="px-4 py-3 font-medium text-sm border-b-2 transition-colors">
                    Active Loans
                    @if ($activeLoans->count() > 0)
                        <span
                            class="ml-2 px-2 py-0.5 text-xs rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                            {{ $activeLoans->count() }}
                        </span>
                    @endif
                </button>
            </div>

            {{-- Pending Loans Tab --}}
            <div x-show="activeTab === 'pending'" x-transition class="card-modern overflow-hidden">
                @if ($pendingLoans->count() > 0)
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Amount</th>
                                <th>Duration</th>
                                <th>Purpose</th>
                                <th>Requested</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingLoans as $loan)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar avatar-sm">{{ substr($loan->user->name, 0, 1) }}</div>
                                            <div>
                                                <p class="font-medium text-secondary-900 dark:text-white">
                                                    {{ $loan->user->name }}</p>
                                                <p class="text-xs text-secondary-500">{{ $loan->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="font-bold text-secondary-900 dark:text-white">
                                        ₦{{ number_format($loan->amount, 2) }}</td>
                                    <td>{{ $loan->duration_months }} months</td>
                                    <td class="max-w-[200px] truncate text-secondary-600 dark:text-secondary-400">
                                        {{ Str::limit($loan->purpose, 40) }}
                                    </td>
                                    <td class="text-secondary-500">{{ $loan->created_at->format('M d, Y') }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.loans.show', $loan->id) }}" class="btn btn-primary btn-sm">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                            Review
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state py-12">
                        <div
                            class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mb-4">
                            <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                        </div>
                        <p class="empty-state-title">All Caught Up!</p>
                        <p class="empty-state-description">No pending loan requests to review.</p>
                    </div>
                @endif
            </div>

            {{-- Active Loans Tab --}}
            <div x-show="activeTab === 'active'" x-transition class="card-modern overflow-hidden" style="display: none;">
                @if ($activeLoans->count() > 0)
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Total Amount</th>
                                <th>Balance</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activeLoans as $loan)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar avatar-sm">{{ substr($loan->user->name, 0, 1) }}</div>
                                            <div>
                                                <p class="font-medium text-secondary-900 dark:text-white">
                                                    {{ $loan->user->name }}</p>
                                                <p class="text-xs text-secondary-500">#{{ $loan->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="font-medium">₦{{ number_format($loan->amount, 2) }}</td>
                                    <td class="font-bold text-amber-600">₦{{ number_format($loan->balance_remaining, 2) }}
                                    </td>
                                    <td>
                                        <div class="w-24">
                                            <div class="flex items-center justify-between text-xs mb-1">
                                                <span
                                                    class="text-secondary-500">{{ round(($loan->amount_repaid / max($loan->amount, 1)) * 100) }}%</span>
                                            </div>
                                            <div class="w-full bg-secondary-200 dark:bg-secondary-700 rounded-full h-1.5">
                                                <div class="bg-primary h-1.5 rounded-full"
                                                    style="width: {{ ($loan->amount_repaid / max($loan->amount, 1)) * 100 }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Running</span>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.loans.show', $loan->id) }}"
                                            class="btn btn-secondary btn-sm">
                                            <i data-lucide="settings" class="w-4 h-4"></i>
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state py-12">
                        <i data-lucide="file-x" class="w-12 h-12 text-secondary-400 mb-4"></i>
                        <p class="empty-state-title">No Active Loans</p>
                        <p class="empty-state-description">There are no active loans at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
