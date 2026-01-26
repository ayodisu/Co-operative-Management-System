@extends('layouts.modern')

@section('title', 'Support Tickets')

@section('content')
    <div class="animate-in">
        {{-- Page Header --}}
        <div class="page-header">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                    <i data-lucide="headphones" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h1 class="page-title">Support Tickets</h1>
                    <p class="page-description">Manage and respond to member inquiries.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div
                    class="hidden sm:flex flex-col items-end mr-4 border-r border-secondary-200 dark:border-secondary-800 pr-4">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-secondary-400">Total Open</span>
                    <span class="text-sm font-black text-amber-600">{{ $tickets->where('status', 'open')->count() }}</span>
                </div>
            </div>
        </div>

        {{-- Main Table Card --}}
        <div class="card-modern overflow-hidden">
            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Subject & ID</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Member</th>
                            <th>Submitted</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-100 dark:divide-secondary-800">
                        @forelse($tickets as $ticket)
                            <tr class="hover:bg-secondary-50/50 dark:hover:bg-secondary-800/50 transition-colors">
                                <td>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-bold text-secondary-900 dark:text-white truncate max-w-xs">
                                            {{ $ticket->subject }}
                                        </span>
                                        <span
                                            class="text-[10px] font-bold text-secondary-400 uppercase tracking-tighter">#TKT-{{ $ticket->id }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if ($ticket->status == 'open')
                                        <span class="badge badge-warning">Awaiting Action</span>
                                    @elseif($ticket->status == 'replied')
                                        <span class="badge badge-info">Staff Replied</span>
                                    @elseif($ticket->status == 'closed')
                                        <span class="badge badge-success">Resolved</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($ticket->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="text-[11px] font-bold uppercase tracking-wider {{ $ticket->priority == 'high' ? 'text-red-500' : ($ticket->priority == 'medium' ? 'text-amber-500' : 'text-green-500') }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center text-[10px] font-bold text-secondary-500">
                                            {{ strtoupper(substr($ticket->user->name, 0, 1)) }}
                                        </div>
                                        <span
                                            class="text-xs font-medium text-secondary-700 dark:text-secondary-300">{{ $ticket->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-xs font-medium text-secondary-600 dark:text-secondary-400">{{ $ticket->created_at->format('M d, Y') }}</span>
                                        <span
                                            class="text-[10px] text-secondary-400">{{ $ticket->created_at->diffForHumans() }}</span>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.support.show', $ticket) }}"
                                        class="btn btn-secondary btn-sm rounded-xl">
                                        Open Chat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-secondary-500 italic">
                                    No support tickets found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($tickets->hasPages())
                <div class="p-6 border-t border-secondary-100 dark:border-secondary-800">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
