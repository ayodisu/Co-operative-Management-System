@extends('layouts.modern')

@section('title', 'Activity Logs')

@section('content')
    <div class="animate-in">
        {{-- Page Header --}}
        <div class="page-header">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center">
                    <i data-lucide="scroll-text" class="w-6 h-6 text-secondary-600 dark:text-secondary-400"></i>
                </div>
                <div>
                    <h1 class="page-title">Activity Logs</h1>
                    <p class="page-description">Track all system actions and administrative changes.</p>
                </div>
            </div>
        </div>

        {{-- Filter Card --}}
        <div
            class="card-modern p-6 mb-8 flex flex-col md:flex-row items-end gap-6 bg-secondary-50/50 dark:bg-secondary-800/30 border-dashed">
            <form action="{{ route('admin.activity-logs.index') }}" method="GET"
                class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
                <div>
                    <label class="input-label">Type</label>
                    <select name="log_name" class="input-modern">
                        <option value="">All Types</option>
                        @foreach ($logNames as $name)
                            <option value="{{ $name }}" {{ request('log_name') == $name ? 'selected' : '' }}>
                                {{ ucfirst($name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="input-label">Start Date</label>
                    <input type="date" name="start_date" class="input-modern" value="{{ request('start_date') }}">
                </div>
                <div>
                    <label class="input-label">End Date</label>
                    <input type="date" name="end_date" class="input-modern" value="{{ request('end_date') }}">
                </div>
            </form>
            <div class="flex gap-2">
                <button type="submit" form="filterForm" class="btn btn-primary h-[46px] px-6">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                </button>
                <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-secondary h-[46px] px-6">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                </a>
            </div>
            <form id="filterForm" action="{{ route('admin.activity-logs.index') }}" method="GET" class="hidden"></form>
        </div>

        {{-- Logs Table --}}
        <div class="card-modern overflow-hidden">
            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>User</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-100 dark:divide-secondary-800 text-sm">
                        @forelse ($logs as $log)
                            <tr class="hover:bg-secondary-50/50 dark:hover:bg-secondary-800/50 transition-colors">
                                <td class="whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-secondary-900 dark:text-white">{{ $log->created_at->format('H:i:s') }}</span>
                                        <span
                                            class="text-[10px] text-secondary-500 font-medium">{{ $log->created_at->format('M d, Y') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="px-2 py-0.5 rounded-lg bg-primary-50 dark:bg-primary-900/10 text-[10px] font-black text-primary uppercase tracking-widest border border-primary-100 dark:border-primary-900/20">
                                        {{ $log->log_name ?? 'general' }}
                                    </span>
                                </td>
                                <td>
                                    <p class="text-secondary-700 dark:text-secondary-300 font-medium max-w-md truncate">
                                        {{ $log->description }}
                                    </p>
                                </td>
                                <td>
                                    @if ($log->causer)
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center text-[10px] font-bold text-secondary-600">
                                                {{ strtoupper(substr($log->causer->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-xs font-bold text-secondary-900 dark:text-white leading-none mb-1">{{ $log->causer->name ?? 'Unknown' }}</span>
                                                <span
                                                    class="text-[9px] font-bold text-secondary-400 uppercase tracking-tighter">{{ class_basename($log->causer_type) }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 text-secondary-400">
                                            <i data-lucide="cpu" class="w-3.5 h-3.5"></i>
                                            <span class="text-xs font-bold uppercase tracking-widest">System</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if ($log->properties && count($log->properties) > 0)
                                        <div x-data="{ open: false }">
                                            <button @click="open = true"
                                                class="p-2 text-secondary-400 hover:text-primary transition-colors">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </button>

                                            {{-- Mini Modal Placeholder --}}
                                            <template x-if="open">
                                                <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-secondary-900/60 backdrop-blur-sm"
                                                    @click.self="open = false">
                                                    <div
                                                        class="bg-white dark:bg-secondary-900 rounded-3xl w-full max-w-lg shadow-2xl border border-secondary-100 dark:border-secondary-800 p-8">
                                                        <div class="flex items-center justify-between mb-6">
                                                            <h3 class="font-bold text-lg">Change Details</h3>
                                                            <button @click="open = false"
                                                                class="p-2 rounded-xl hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors">
                                                                <i data-lucide="x" class="w-5 h-5"></i>
                                                            </button>
                                                        </div>
                                                        <div
                                                            class="bg-secondary-50 dark:bg-secondary-950 p-6 rounded-2xl overflow-x-auto border border-secondary-100 dark:border-secondary-800">
                                                            <pre class="text-xs font-mono text-secondary-700 dark:text-secondary-300 leading-relaxed">{{ json_encode($log->properties, JSON_PRETTY_PRINT) }}</pre>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    @else
                                        <span class="text-secondary-300">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 rounded-3xl bg-secondary-50 dark:bg-secondary-800/50 flex items-center justify-center mb-4">
                                            <i data-lucide="ghost" class="w-8 h-8 text-secondary-300"></i>
                                        </div>
                                        <p class="text-secondary-500 font-medium">No activity logs found for this period.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($logs->hasPages())
                <div class="p-6 border-t border-secondary-100 dark:border-secondary-800">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
