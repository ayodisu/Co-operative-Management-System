@extends('layouts.modern')

@section('title', 'Member Details')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.members.index') }}" class="btn btn-ghost">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </a>
                <div>
                    <h1 class="page-title">{{ $member->name }}</h1>
                    <p class="page-description">{{ $member->email }}</p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-secondary">
                    <i data-lucide="edit" class="w-4 h-4"></i>
                    Edit Profile
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Profile Card --}}
            <div class="lg:col-span-1">
                <div class="card-modern p-6 text-center">
                    <div
                        class="avatar avatar-xl bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 mx-auto mb-4">
                        {{ substr($member->name, 0, 1) }}
                    </div>
                    <h3 class="font-bold text-lg text-secondary-900 dark:text-white">{{ $member->name }}</h3>
                    <p class="text-secondary-500 dark:text-secondary-400 text-sm mb-3">{{ $member->email }}</p>

                    @if ($member->status === 'suspended')
                        <span class="badge badge-danger">Suspended</span>
                    @else
                        <span class="badge badge-success">Active</span>
                    @endif

                    <div class="border-t border-secondary-100 dark:border-secondary-700 mt-6 pt-6 space-y-3">
                        <form action="{{ route('admin.members.suspend', $member->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="btn {{ $member->status === 'suspended' ? 'btn-primary' : 'btn-secondary' }} w-full">
                                <i data-lucide="{{ $member->status === 'suspended' ? 'user-check' : 'user-x' }}"
                                    class="w-4 h-4"></i>
                                {{ $member->status === 'suspended' ? 'Reactivate' : 'Suspend' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-full">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                Delete Member
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="card-modern p-6 mt-6">
                    <h4 class="font-semibold text-secondary-900 dark:text-white mb-4">Financial Overview</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-secondary-500 dark:text-secondary-400">Total Contributions</span>
                            <span
                                class="font-bold text-green-600">₦{{ number_format($member->profile->total_contributions ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-secondary-500 dark:text-secondary-400">Loan Balance</span>
                            <span
                                class="font-bold text-red-600">₦{{ number_format($member->profile->current_loan_balance ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-secondary-500 dark:text-secondary-400">Monthly Contribution</span>
                            <span
                                class="font-bold text-secondary-900 dark:text-white">₦{{ number_format($member->profile->monthly_contribution ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Member Details --}}
                <div class="card-modern p-6">
                    <h4 class="font-semibold text-secondary-900 dark:text-white mb-4 flex items-center gap-2">
                        <i data-lucide="user" class="w-5 h-5 text-primary"></i>
                        Member Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">Phone Number</p>
                            <p class="font-medium text-secondary-900 dark:text-white">
                                {{ $member->profile->phone ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">Address</p>
                            <p class="font-medium text-secondary-900 dark:text-white">
                                {{ $member->profile->address ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">Member Since</p>
                            <p class="font-medium text-secondary-900 dark:text-white">
                                {{ $member->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">Loan Limit</p>
                            <p class="font-medium text-secondary-900 dark:text-white">
                                ₦{{ number_format(($member->profile->monthly_contribution ?? 0) * 30, 2) }}</p>
                        </div>
                    </div>
                </div>

                {{-- Quick Savings Transaction --}}
                <div class="card-modern p-6">
                    <h4 class="font-semibold text-secondary-900 dark:text-white mb-4 flex items-center gap-2">
                        <i data-lucide="piggy-bank" class="w-5 h-5 text-primary"></i>
                        Quick Savings Transaction
                    </h4>
                    <form action="{{ route('admin.savings.store') }}" method="POST"
                        class="flex flex-wrap gap-4 items-end">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $member->id }}">
                        <div class="flex-1 min-w-[150px]">
                            <label class="input-label">Amount</label>
                            <input type="number" name="amount" class="input-modern" placeholder="0.00" step="0.01"
                                required>
                        </div>
                        <div class="flex-1 min-w-[150px]">
                            <label class="input-label">Type</label>
                            <select name="type" class="input-modern" required>
                                <option value="deposit">Deposit</option>
                                <option value="withdrawal">Withdrawal</option>
                            </select>
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <label class="input-label">Description</label>
                            <input type="text" name="description" class="input-modern" placeholder="Optional note">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Add Transaction
                        </button>
                    </form>
                </div>

                {{-- Recent Savings --}}
                <div class="card-modern overflow-hidden">
                    <div class="p-6 border-b border-secondary-100 dark:border-secondary-700">
                        <h4 class="font-semibold text-secondary-900 dark:text-white flex items-center gap-2">
                            <i data-lucide="history" class="w-5 h-5 text-primary"></i>
                            Recent Savings Transactions
                        </h4>
                    </div>
                    @if ($member->savingsTransactions->count() > 0)
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th class="text-right">Amount</th>
                                    <th class="text-right">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member->savingsTransactions as $txn)
                                    <tr>
                                        <td>{{ $txn->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if ($txn->type === 'deposit')
                                                <span class="badge badge-success">Deposit</span>
                                            @elseif($txn->type === 'withdrawal')
                                                <span class="badge badge-danger">Withdrawal</span>
                                            @else
                                                <span class="badge badge-info">Interest</span>
                                            @endif
                                        </td>
                                        <td
                                            class="text-right font-semibold {{ $txn->type === 'withdrawal' ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $txn->type === 'withdrawal' ? '-' : '+' }}₦{{ number_format($txn->amount, 2) }}
                                        </td>
                                        <td class="text-right font-medium">₦{{ number_format($txn->balance_after, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state py-8">
                            <i data-lucide="inbox" class="w-8 h-8 text-secondary-400 mb-2"></i>
                            <p class="text-secondary-500">No savings transactions yet</p>
                        </div>
                    @endif
                </div>

                {{-- Loans --}}
                <div class="card-modern overflow-hidden">
                    <div class="p-6 border-b border-secondary-100 dark:border-secondary-700">
                        <h4 class="font-semibold text-secondary-900 dark:text-white flex items-center gap-2">
                            <i data-lucide="banknote" class="w-5 h-5 text-primary"></i>
                            Loan History
                        </h4>
                    </div>
                    @if ($member->loans->count() > 0)
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member->loans as $loan)
                                    <tr>
                                        <td>{{ $loan->created_at->format('M d, Y') }}</td>
                                        <td class="font-semibold">₦{{ number_format($loan->amount, 2) }}</td>
                                        <td>{{ $loan->duration_months }} months</td>
                                        <td>
                                            @if ($loan->status === 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif(in_array($loan->status, ['approved', 'running']))
                                                <span class="badge badge-success">Running</span>
                                            @elseif($loan->status === 'repaid')
                                                <span class="badge badge-info">Repaid</span>
                                            @else
                                                <span class="badge badge-danger">{{ ucfirst($loan->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.loans.show', $loan) }}"
                                                class="btn btn-ghost btn-sm">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state py-8">
                            <i data-lucide="file-x" class="w-8 h-8 text-secondary-400 mb-2"></i>
                            <p class="text-secondary-500">No loans yet</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
