@extends('layouts.modern')

@section('title', 'Members')

@section('content')
    <div class="animate-in">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Members</h1>
                <p class="page-description">Manage cooperative members and their profiles.</p>
            </div>
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.members.index') }}" method="GET" class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search members..."
                        class="pl-10 pr-4 py-2.5 bg-white dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                </form>
            </div>
        </div>

        {{-- Members Table --}}
        <div class="card-modern overflow-hidden">
            @if ($members->count() > 0)
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Contributions</th>
                                <th>Loan Balance</th>
                                <th>Monthly</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="avatar avatar-md bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-secondary-900 dark:text-white">
                                                    {{ $member->name }}</p>
                                                <p class="text-sm text-secondary-500 dark:text-secondary-400">
                                                    {{ $member->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="font-semibold text-green-600">
                                        ₦{{ number_format($member->profile->total_contributions ?? 0, 2) }}
                                    </td>
                                    <td
                                        class="font-semibold {{ ($member->profile->current_loan_balance ?? 0) > 0 ? 'text-red-600' : 'text-secondary-500' }}">
                                        ₦{{ number_format($member->profile->current_loan_balance ?? 0, 2) }}
                                    </td>
                                    <td class="text-secondary-700 dark:text-secondary-300">
                                        ₦{{ number_format($member->profile->monthly_contribution ?? 0, 2) }}
                                    </td>
                                    <td>
                                        @if ($member->is_suspended ?? false)
                                            <span class="badge badge-danger">Suspended</span>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.members.show', $member) }}" class="btn btn-ghost btn-sm">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($members->hasPages())
                    <div class="p-4 border-t border-secondary-100 dark:border-secondary-700">
                        {{ $members->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state py-12">
                    <div
                        class="w-16 h-16 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center mb-4">
                        <i data-lucide="users" class="w-8 h-8 text-secondary-400"></i>
                    </div>
                    <p class="empty-state-title">No Members Found</p>
                    <p class="empty-state-description">No members match your search criteria.</p>
                </div>
            @endif
        </div>

    </div>
@endsection
