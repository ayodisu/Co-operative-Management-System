@extends('layouts.modern')

@section('title', 'Ticket Details')

@section('content')
    <div class="animate-in max-w-6xl mx-auto h-[calc(100vh-100px)] flex flex-col -mt-4 lg:-mt-6">
        {{-- Modern Chat Layout --}}
        <div class="card-modern flex flex-1 min-h-0 overflow-hidden shadow-2xl">

            {{-- Main Chat Section --}}
            <div class="flex-1 flex flex-col min-w-0 bg-white dark:bg-secondary-900">

                {{-- Compact Chat Header --}}
                <div
                    class="px-6 py-3 border-b border-secondary-100 dark:border-secondary-800 flex items-center justify-between bg-white/50 dark:bg-secondary-900/50 backdrop-blur-md sticky top-0 z-10">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('support.index') }}"
                            class="p-2 -ml-2 rounded-xl hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors text-secondary-500"
                            title="Back">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        </a>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-2xl bg-primary-100 dark:bg-primary-900/40 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="headphones" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div class="min-w-0">
                                <h1 class="text-sm font-bold text-secondary-900 dark:text-white truncate">Ticket
                                    #{{ $ticket->id }}</h1>
                                <p class="text-[11px] font-medium text-secondary-500 truncate max-w-[200px] md:max-w-md">
                                    {{ $ticket->subject }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex flex-col items-end mr-3">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-secondary-400">Priority</span>
                            <span
                                class="text-[11px] font-bold {{ $ticket->priority == 'high' ? 'text-red-500' : ($ticket->priority == 'medium' ? 'text-amber-500' : 'text-green-500') }}">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </div>
                        @if ($ticket->status == 'open')
                            <span
                                class="px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-[10px] font-bold uppercase tracking-wider">Open</span>
                        @elseif($ticket->status == 'replied')
                            <span
                                class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-[10px] font-bold uppercase tracking-wider">Replied</span>
                        @elseif($ticket->status == 'closed')
                            <span
                                class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-[10px] font-bold uppercase tracking-wider">Closed</span>
                        @endif
                    </div>
                </div>

                {{-- Messages Area --}}
                <div id="chatMessages" class="flex-1 overflow-y-auto p-6 space-y-8 scroll-smooth scrollbar-thin">
                    {{-- Date Separator logic --}}
                    @php $prevDate = null; @endphp
                    @foreach ($ticket->messages as $message)
                        @php
                            $isMe = $message->user_id === Auth::id();
                            $currentDate = $message->created_at->format('M d, Y');
                        @endphp

                        @if ($prevDate !== $currentDate)
                            <div class="flex justify-center my-8">
                                <span
                                    class="px-4 py-1 rounded-full bg-secondary-100 dark:bg-secondary-800/50 text-[10px] font-bold uppercase tracking-widest text-secondary-500">
                                    {{ $currentDate }}
                                </span>
                            </div>
                            @php $prevDate = $currentDate; @endphp
                        @endif

                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} items-end gap-3 px-2 group">
                            @if (!$isMe)
                                <div
                                    class="w-8 h-8 rounded-xl bg-secondary-200 dark:bg-secondary-800 flex items-center justify-center flex-shrink-0 text-[10px] font-bold text-secondary-600 dark:text-secondary-400 shadow-sm">
                                    {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                </div>
                            @endif

                            <div
                                class="max-w-[80%] md:max-w-[70%] flex flex-col {{ $isMe ? 'items-end' : 'items-start' }} gap-1.5">
                                <div
                                    class="px-5 py-3 rounded-2xl shadow-sm text-sm leading-relaxed transition-all
                                    {{ $isMe
                                        ? 'bg-primary text-white rounded-br-none'
                                        : 'bg-secondary-100 dark:bg-secondary-800 text-secondary-900 dark:text-secondary-100 rounded-bl-none border border-secondary-200/50 dark:border-secondary-700/50' }}">
                                    {!! nl2br(e($message->message)) !!}
                                </div>
                                <div
                                    class="flex items-center gap-2 px-1 text-[10px] font-medium text-secondary-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span>{{ $message->created_at->format('g:i A') }}</span>
                                    @if (!$isMe)
                                        <span>•</span>
                                        <span>{{ $message->user->name }}</span>
                                    @endif
                                </div>
                            </div>

                            @if ($isMe)
                                <div
                                    class="w-8 h-8 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0 text-[10px] font-bold text-primary shadow-sm">
                                    {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Input Area --}}
                <div
                    class="p-6 bg-white dark:bg-secondary-900 border-t border-secondary-100 dark:border-secondary-800 flex-shrink-0">
                    @if ($ticket->status !== 'closed')
                        <form id="replyForm" method="POST" action="{{ route('support.reply', $ticket) }}"
                            class="flex items-end gap-3 max-w-5xl mx-auto">
                            @csrf
                            <div class="flex-1 relative group">
                                <textarea name="message" id="messageInput"
                                    class="input-modern w-full min-h-[56px] max-h-48 py-4 px-6 resize-none overflow-y-auto scrollbar-none rounded-3xl shadow-inner-sm bg-secondary-50 dark:bg-secondary-800/50 border-secondary-200 dark:border-secondary-700 focus:bg-white dark:focus:bg-secondary-800 focus:ring-4 focus:ring-primary/10 transition-all font-medium text-[15px]"
                                    placeholder="Type your message here..." required></textarea>
                                <div
                                    class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-bold text-secondary-400 pointer-events-none hidden md:block opacity-0 group-focus-within:opacity-100 transition-opacity uppercase tracking-wider">
                                    Enter to send
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-primary h-[56px] w-[56px] p-0 rounded-full flex-shrink-0 shadow-xl shadow-primary/30 hover:scale-110 active:scale-95 transition-all text-white"
                                title="Send (Enter)">
                                <i data-lucide="send" class="w-6 h-6"></i>
                            </button>
                        </form>
                    @else
                        <div
                            class="flex flex-col items-center gap-3 py-4 text-secondary-500 bg-secondary-50 dark:bg-secondary-800/30 rounded-3xl border border-dashed border-secondary-200 dark:border-secondary-700">
                            <div class="flex items-center gap-2 text-sm font-semibold italic">
                                <i data-lucide="lock" class="w-4 h-4"></i>
                                This ticket is closed and read-only.
                            </div>
                            <a href="{{ route('support.create') }}"
                                class="text-xs font-bold text-primary hover:underline uppercase tracking-widest">
                                Open a new ticket instead
                            </a>
                        </div>
                    @endif
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

                // Enter to submit
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
