@extends('layouts.modern')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
    <div class="animate-in max-w-full mx-auto h-[calc(100vh-100px)] flex flex-col -mt-4 lg:-mt-6">

        {{-- Main Layout: Chat + User Info --}}
        <div class="flex flex-1 min-h-0 gap-6">

            {{-- Left: Chat Interface --}}
            <div class="flex-1 flex flex-col min-w-0">
                <div
                    class="card-modern flex flex-1 min-h-0 overflow-hidden shadow-2xl bg-white dark:bg-secondary-900 border-none">

                    {{-- Compact Chat Header --}}
                    <div
                        class="px-6 py-3 border-b border-secondary-100 dark:border-secondary-800 flex items-center justify-between bg-white/50 dark:bg-secondary-900/50 backdrop-blur-md sticky top-0 z-10">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.tickets.index') }}"
                                class="p-2 -ml-2 rounded-xl hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors text-secondary-500"
                                title="Back">
                                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            </a>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="ticket" class="w-5 h-5 text-secondary-600 dark:text-secondary-400"></i>
                                </div>
                                <div class="min-w-0">
                                    <h1 class="text-sm font-bold text-secondary-900 dark:text-white truncate">Ticket
                                        #{{ $ticket->id }}</h1>
                                    <p
                                        class="text-[11px] font-medium text-secondary-500 truncate max-w-[200px] md:max-w-md">
                                        {{ $ticket->subject }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="hidden sm:flex flex-col items-end mr-4 border-r border-secondary-200 dark:border-secondary-800 pr-4 text-right">
                                <span
                                    class="text-[10px] font-bold uppercase tracking-widest text-secondary-400">Status</span>
                                <span class="text-xs font-semibold">
                                    @if ($ticket->status == 'open')
                                        <span class="text-amber-500">Awaiting Response</span>
                                    @elseif($ticket->status == 'replied')
                                        <span class="text-blue-500">Staff Replied</span>
                                    @else
                                        <span class="text-green-500">Resolved & Closed</span>
                                    @endif
                                </span>
                            </div>

                            @if ($ticket->status !== 'closed')
                                <form action="{{ route('admin.support.close', $ticket) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-secondary btn-sm border-red-100 dark:border-red-900/20 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl"
                                        onclick="return confirm('Mark this ticket as resolved and close it?')">
                                        <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                        Resolve
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>



                    {{-- Messages Area --}}
                    <div id="chatMessages" class="flex-1 overflow-y-auto p-6 space-y-8 scroll-smooth scrollbar-thin">
                        @php
                            $prevDate = null;
                        @endphp
                        @foreach ($ticket->messages as $message)
                            @php
                                $isStaff = $message->user_id === Auth::id();
                                $currentDate = $message->created_at->format('M d, Y');
                            @endphp

                            @if ($prevDate !== $currentDate)
                                <div class="flex justify-center my-8">
                                    <span
                                        class="px-4 py-1.5 rounded-full bg-secondary-100 dark:bg-secondary-800 text-[10px] font-bold uppercase tracking-widest text-secondary-500">
                                        {{ $currentDate }}
                                    </span>
                                </div>
                                @php $prevDate = $currentDate; @endphp
                            @endif

                            <div class="flex {{ $isStaff ? 'justify-end' : 'justify-start' }} items-end gap-3 px-2 group">
                                @if (!$isStaff)
                                    <div
                                        class="w-8 h-8 rounded-lg bg-secondary-200 dark:bg-secondary-700 flex items-center justify-center flex-shrink-0 text-[10px] font-bold">
                                        {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div class="max-w-[70%] flex flex-col {{ $isStaff ? 'items-end' : 'items-start' }} gap-1.5">
                                    <div
                                        class="px-5 py-3 rounded-2xl shadow-sm text-sm leading-relaxed transition-all
                                        {{ $isStaff
                                            ? 'bg-primary text-white rounded-br-none'
                                            : 'bg-white dark:bg-secondary-800 text-secondary-900 dark:text-secondary-100 rounded-bl-none border border-secondary-200 dark:border-secondary-700' }}">
                                        {!! nl2br(e($message->message)) !!}
                                    </div>
                                    <div
                                        class="flex items-center gap-2 px-1 text-[10px] font-medium text-secondary-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span>{{ $message->created_at->format('g:i A') }}</span>
                                        <span>•</span>
                                        <span>{{ $message->user->name }} {{ $isStaff ? '(Staff)' : '' }}</span>
                                    </div>
                                </div>

                                @if ($isStaff)
                                    <div
                                        class="w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/40 flex items-center justify-center flex-shrink-0 text-[10px] font-bold text-primary">
                                        S
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Input Area --}}
                    <div
                        class="p-4 bg-white dark:bg-secondary-900 border-t border-secondary-100 dark:border-secondary-800 flex-shrink-0">
                        @if ($ticket->status !== 'closed')
                            <form id="replyForm" method="POST" action="{{ route('admin.support.reply', $ticket) }}"
                                class="flex items-end gap-3 max-w-full">
                                @csrf
                                <div class="flex-1 relative">
                                    <textarea name="message" id="messageInput"
                                        class="input-modern w-full min-h-[52px] max-h-48 py-3.5 pr-14 pl-6 resize-none overflow-y-auto scrollbar-none rounded-2xl shadow-inner-sm bg-secondary-50/50 dark:bg-secondary-900/50 border-secondary-200 dark:border-secondary-700 focus:bg-white dark:focus:bg-secondary-800 transition-all font-medium"
                                        placeholder="Type your reply here..." required></textarea>
                                    <label
                                        class="absolute right-4 bottom-3.5 text-[10px] font-medium text-secondary-400 pointer-events-none hidden md:block">
                                        Shift + Enter to send
                                    </label>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary h-[52px] w-[52px] p-0 rounded-2xl flex-shrink-0 shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all"
                                    title="Send (Enter)">
                                    <i data-lucide="send" class="w-6 h-6"></i>
                                </button>
                            </form>
                        @else
                            <div
                                class="flex items-center justify-center gap-2 py-4 text-green-600 bg-green-50 dark:bg-green-900/10 rounded-xl border border-green-100 dark:border-green-900/20">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                                <span class="text-sm font-semibold italic">This ticket is resolved and closed for further
                                    conversation.</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right: User Info Panel --}}
            <div class="hidden xl:block w-80 space-y-6 flex-shrink-0 h-full overflow-y-auto scrollbar-none">
                <div class="card-modern p-6 shadow-xl border-none h-fit">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-secondary-400 mb-8 flex items-center gap-2">
                        <i data-lucide="user-cog" class="w-4 h-4"></i>
                        Member Profile
                    </h3>

                    <div class="flex flex-col items-center text-center mb-8">
                        <div
                            class="w-24 h-24 rounded-[2.5rem] bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-3xl font-black text-primary mb-5 shadow-lg shadow-primary/10 border-4 border-white dark:border-secondary-800">
                            {{ strtoupper(substr($ticket->user->name, 0, 1)) }}
                        </div>
                        <h4 class="text-xl font-bold text-secondary-900 dark:text-white leading-tight">
                            {{ $ticket->user->name }}</h4>
                        <p class="text-xs font-medium text-secondary-500 mt-1">{{ $ticket->user->email }}</p>
                    </div>

                    <div class="space-y-1">
                        <div
                            class="flex items-center justify-between p-3 rounded-2xl hover:bg-secondary-50 dark:hover:bg-secondary-800/50 transition-colors">
                            <span class="text-xs font-bold text-secondary-400 uppercase tracking-tighter">Total
                                Tickets</span>
                            <span
                                class="text-sm font-bold text-secondary-900 dark:text-white bg-secondary-100 dark:bg-secondary-800 px-3 py-1 rounded-full">{{ $ticket->user->tickets->count() }}</span>
                        </div>
                        <div
                            class="flex items-center justify-between p-3 rounded-2xl hover:bg-secondary-50 dark:hover:bg-secondary-800/50 transition-colors">
                            <span class="text-xs font-bold text-secondary-400 uppercase tracking-tighter">Joined</span>
                            <span
                                class="text-xs font-bold text-secondary-900 dark:text-white">{{ $ticket->user->created_at->format('M Y') }}</span>
                        </div>
                        <div
                            class="flex items-center justify-between p-3 rounded-2xl hover:bg-secondary-50 dark:hover:bg-secondary-800/50 transition-colors">
                            <span class="text-xs font-bold text-secondary-400 uppercase tracking-tighter">Member ID</span>
                            <span
                                class="text-xs font-bold text-secondary-900 dark:text-white">#MEM-{{ 1000 + $ticket->user->id }}</span>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-secondary-100 dark:border-secondary-800">
                        <h3 class="text-[10px] font-bold uppercase tracking-widest text-secondary-400 mb-4">Internal Notes
                        </h3>
                        <div
                            class="p-4 bg-secondary-50 dark:bg-secondary-800/50 rounded-2xl border border-secondary-200 dark:border-secondary-700">
                            <p class="text-[11px] text-secondary-500 leading-relaxed italic">
                                "Always verify repayment history before approving new loan-related ticket requests."
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Action Panel --}}
                <div
                    class="card-modern p-6 bg-secondary-900 dark:bg-secondary-950 text-white border-none shadow-2xl relative overflow-hidden group">
                    <div
                        class="absolute -top-10 -right-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl group-hover:bg-primary/30 transition-all">
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-primary mb-4 flex items-center gap-2">
                            <i data-lucide="zap" class="w-3 h-3 fill-primary"></i>
                            Admin Tips
                        </h3>
                        <p class="text-xs text-secondary-300 leading-relaxed mb-6">
                            Resolved tickets are archived but can still be viewed by the user for future reference.
                        </p>
                        <div class="space-y-3">
                            <div
                                class="flex items-center gap-3 text-[10px] font-bold text-secondary-400 uppercase tracking-wider">
                                <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
                                Keep tone professional
                            </div>
                            <div
                                class="flex items-center gap-3 text-[10px] font-bold text-secondary-400 uppercase tracking-wider">
                                <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
                                Check member level
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatMessages = document.getElementById('chatMessages');
            const messageInput = document.getElementById('messageInput');
            const replyForm = document.getElementById('replyForm');

            // Initial scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;

            if (messageInput) {
                // Auto-expand textarea
                messageInput.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                    if (this.scrollHeight > 192) {
                        this.style.overflowY = 'auto';
                    } else {
                        this.style.overflowY = 'hidden';
                    }
                });

                // Submit on Enter
                messageInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        if (this.value.trim().length > 0) {
                            replyForm.submit();
                        }
                    }
                });
            }
        });
    </script>
@endsection
