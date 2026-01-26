@extends('layouts.modern')

@section('title', 'Repayment Schedule')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Repayment Schedule</h1>
                <p class="page-description">View your upcoming loan repayment schedule.</p>
            </div>
            @if (isset($loan))
                <a href="{{ route('reports.loan', $loan) }}" class="btn btn-primary">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Download Statement
                </a>
            @endif
        </div>

        @if (isset($loan) && $loan)
            {{-- Loan Summary --}}
            <div class="card-modern p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-1">Loan Amount</p>
                        <p class="text-xl font-bold text-secondary-900 dark:text-white">
                            ₦{{ number_format($loan->amount, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-1">Duration</p>
                        <p class="text-xl font-bold text-secondary-900 dark:text-white">{{ $loan->duration_months }} months
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-1">Monthly Payment</p>
                        <p class="text-xl font-bold text-secondary-900 dark:text-white">
                            ₦{{ number_format($loan->amount / $loan->duration_months, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-1">Status</p>
                        @if ($loan->status === 'pending')
                            <span class="badge badge-warning">Pending Approval</span>
                        @elseif($loan->status === 'approved' || $loan->status === 'running')
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-info">{{ ucfirst($loan->status) }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Schedule Table --}}
            <div class="card-modern overflow-hidden">
                <div class="p-6 border-b border-secondary-100 dark:border-secondary-700">
                    <h3 class="font-semibold text-secondary-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="calendar" class="w-5 h-5 text-primary"></i>
                        Payment Schedule
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Due Date</th>
                                <th class="text-right">Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule as $index => $payment)
                                <tr>
                                    <td class="font-medium text-secondary-900 dark:text-white">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="calendar-days" class="w-4 h-4 text-secondary-400"></i>
                                            {{ $payment->due_date->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td class="text-right font-semibold text-secondary-900 dark:text-white">
                                        ₦{{ number_format($payment->amount, 2) }}
                                    </td>
                                    <td>
                                        @if ($payment->paid_at)
                                            <span class="badge badge-success">
                                                <i data-lucide="check" class="w-3 h-3 mr-1"></i>
                                                Paid
                                            </span>
                                        @elseif($payment->status === 'overdue')
                                            <span class="badge badge-danger">
                                                <i data-lucide="alert-triangle" class="w-3 h-3 mr-1"></i>
                                                Overdue
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            {{-- No Active Loan --}}
            <div class="card-modern">
                <div class="empty-state py-12">
                    <div
                        class="w-16 h-16 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center mb-4">
                        <i data-lucide="calendar-x" class="w-8 h-8 text-secondary-400"></i>
                    </div>
                    <p class="empty-state-title">No Active Loan</p>
                    <p class="empty-state-description">You don't have an active loan to view a repayment schedule for. Apply
                        for a loan to get started.</p>
                    <a href="{{ route('loans.apply') }}" class="btn btn-primary mt-4">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Apply for Loan
                    </a>
                </div>
            </div>
        @endif

    </div>
@endsection
