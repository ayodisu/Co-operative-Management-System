@extends('layouts.modern')

@section('title', 'Support Tickets')

@section('content')
    <div class="animate-in">
        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Support Tickets</h1>
                <p class="page-description">Review and manage your support requests.</p>
            </div>
            <a href="{{ route('support.create') }}" class="btn btn-primary">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Open New Ticket
            </a>
        </div>

        {{-- Tickets Card --}}
        <div class="card-modern">
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Submitted</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr class="group">
                                <td class="font-medium text-secondary-900 dark:text-white">
                                    {{ Str::limit($ticket->subject, 50) }}
                                </td>
                                <td>
                                    @if ($ticket->status == 'open')
                                        <span class="badge badge-warning">Open</span>
                                    @elseif($ticket->status == 'replied')
                                        <span class="badge badge-info">Replied</span>
                                    @elseif($ticket->status == 'closed')
                                        <span class="badge badge-success">Closed</span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2 py-1 rounded-lg text-xs font-semibold
                                        {{ $ticket->priority == 'high'
                                            ? 'bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-400'
                                            : ($ticket->priority == 'medium'
                                                ? 'bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400'
                                                : 'bg-green-50 text-green-700 dark:bg-green-900/20 dark:text-green-400') }}">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full 
                                            {{ $ticket->priority == 'high'
                                                ? 'bg-red-500'
                                                : ($ticket->priority == 'medium'
                                                    ? 'bg-amber-500'
                                                    : 'bg-green-500') }}"></span>
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>
                                <td class="text-secondary-500 dark:text-secondary-400">
                                    {{ $ticket->created_at->diffForHumans() }}
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('support.show', $ticket) }}" class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state py-12">
                                        <div
                                            class="w-16 h-16 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center mb-4">
                                            <i data-lucide="headphones" class="w-8 h-8 text-secondary-400"></i>
                                        </div>
                                        <p class="empty-state-title">No tickets found</p>
                                        <p class="empty-state-description">You haven't opened any support tickets yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
