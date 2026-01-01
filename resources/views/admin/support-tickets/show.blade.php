@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Chat Header -->
            <div class="chat-container">
                <div class="chat-header">
                    <div class="chat-header-info">
                        <div class="chat-avatar">
                            {{ strtoupper(substr($ticket->user->name, 0, 1)) }}
                        </div>
                        <div class="chat-header-text">
                            <h5 class="chat-header-name">{{ $ticket->user->name }}</h5>
                            <span class="chat-header-subject">{{ $ticket->subject }}</span>
                        </div>
                    </div>
                    <div class="chat-header-actions">
                        @if ($ticket->status == 'open')
                            <span class="chat-status chat-status-open">Open</span>
                        @elseif($ticket->status == 'closed')
                            <span class="chat-status chat-status-closed">Closed</span>
                        @else
                            <span class="chat-status chat-status-answered">{{ ucfirst($ticket->status) }}</span>
                        @endif
                    </div>
                </div>

                <!-- Chat Messages -->
                <div class="chat-messages" id="chatMessages">
                    @foreach ($ticket->messages as $message)
                        @php
                            $isMe = $message->user_id === Auth::id();
                        @endphp
                        <div class="message-wrapper {{ $isMe ? 'message-sent' : 'message-received' }}">
                            @if (!$isMe)
                                <div class="message-avatar">
                                    {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="message-content">
                                <div class="message-bubble {{ $isMe ? 'bubble-sent' : 'bubble-received' }}">
                                    {!! nl2br(e($message->message)) !!}
                                </div>
                                <div class="message-meta {{ $isMe ? 'meta-sent' : 'meta-received' }}">
                                    {{ $message->created_at->format('M d, g:i A') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Chat Input -->
                <div class="chat-input-container">
                    @if ($ticket->status !== 'closed')
                        <form id="reply-form" action="{{ route('admin.support.reply', $ticket) }}" method="POST"
                            class="chat-input-form">
                            @csrf
                            <div class="chat-input-wrapper">
                                <textarea name="message" id="messageInput" class="chat-input" placeholder="Aa" required rows="1"></textarea>
                                <button type="submit" class="chat-send-btn" title="Send">
                                    <i class="mdi mdi-send"></i>
                                </button>
                            </div>
                        </form>
                        <div class="chat-actions">
                            <form action="{{ route('admin.support.close', $ticket) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-close-ticket"
                                    onclick="return confirm('Are you sure you want to close this ticket?')">
                                    <i class="mdi mdi-close-circle-outline"></i> Close Ticket
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="chat-closed-notice">
                            <i class="mdi mdi-check-circle"></i> This conversation has been closed
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* Chat Container */
        .chat-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: calc(100vh - 180px);
            min-height: 500px;
        }

        /* Chat Header */
        .chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: #ffffff;
            border-bottom: 1px solid #e4e6eb;
        }

        .chat-header-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0084ff, #00c6ff);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
        }

        .chat-header-name {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            color: #050505;
        }

        .chat-header-subject {
            font-size: 12px;
            color: #65676b;
        }

        .chat-status {
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
        }

        .chat-status-open {
            background: #fff3cd;
            color: #856404;
        }

        .chat-status-closed {
            background: #d4edda;
            color: #155724;
        }

        .chat-status-answered {
            background: #cce5ff;
            color: #004085;
        }

        /* Chat Messages Area */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            background: #f0f2f5;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* Message Wrapper */
        .message-wrapper {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            max-width: 65%;
        }

        .message-wrapper.message-sent {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .message-wrapper.message-received {
            align-self: flex-start;
        }

        /* Message Avatar */
        .message-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #e4e6eb;
            color: #65676b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            flex-shrink: 0;
        }

        /* Message Content */
        .message-content {
            display: flex;
            flex-direction: column;
        }

        .message-bubble {
            padding: 8px 12px;
            border-radius: 18px;
            font-size: 15px;
            line-height: 1.4;
            word-wrap: break-word;
        }

        .bubble-sent {
            background: #0084ff;
            color: #ffffff;
            border-bottom-right-radius: 4px;
        }

        .bubble-received {
            background: #e4e6eb;
            color: #050505;
            border-bottom-left-radius: 4px;
        }

        .message-meta {
            font-size: 11px;
            color: #65676b;
            margin-top: 2px;
            padding: 0 4px;
        }

        .meta-sent {
            text-align: right;
        }

        .meta-received {
            text-align: left;
        }

        /* Chat Input Area */
        .chat-input-container {
            padding: 12px 16px;
            background: #ffffff;
            border-top: 1px solid #e4e6eb;
        }

        .chat-input-form {
            margin: 0;
        }

        .chat-input-wrapper {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            background: #f0f2f5;
            border-radius: 20px;
            padding: 6px 6px 6px 16px;
        }

        .chat-input {
            flex: 1;
            border: none;
            background: transparent;
            resize: none;
            font-size: 15px;
            line-height: 1.4;
            max-height: 100px;
            min-height: 24px;
            padding: 4px 0;
            outline: none;
            color: #050505;
        }

        .chat-input::placeholder {
            color: #65676b;
        }

        .chat-input:focus {
            outline: none;
            box-shadow: none;
        }

        .chat-send-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: #0084ff;
            color: #ffffff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            flex-shrink: 0;
        }

        .chat-send-btn:hover {
            background: #0073e6;
        }

        .chat-send-btn i {
            font-size: 18px;
        }

        .chat-actions {
            margin-top: 8px;
            text-align: right;
        }

        .btn-close-ticket {
            background: transparent;
            border: 1px solid #dc3545;
            color: #dc3545;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-close-ticket:hover {
            background: #dc3545;
            color: #fff;
        }

        .chat-closed-notice {
            text-align: center;
            color: #28a745;
            font-size: 14px;
            padding: 12px;
        }

        .chat-closed-notice i {
            margin-right: 6px;
        }

        /* Scrollbar Styling */
        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: #bcc0c4;
            border-radius: 3px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: #a0a4a8;
        }

        /* ============ DARK MODE ============ */
        body.dark-mode .chat-container {
            background: #242526;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
        }

        body.dark-mode .chat-header {
            background: #242526;
            border-bottom-color: #3e4042;
        }

        body.dark-mode .chat-header-name {
            color: #e4e6eb;
        }

        body.dark-mode .chat-header-subject {
            color: #b0b3b8;
        }

        body.dark-mode .chat-messages {
            background: #18191a;
        }

        body.dark-mode .message-avatar {
            background: #3a3b3c;
            color: #b0b3b8;
        }

        body.dark-mode .bubble-received {
            background: #3a3b3c;
            color: #e4e6eb;
        }

        body.dark-mode .message-meta {
            color: #b0b3b8;
        }

        body.dark-mode .chat-input-container {
            background: #242526;
            border-top-color: #3e4042;
        }

        body.dark-mode .chat-input-wrapper {
            background: #3a3b3c;
        }

        body.dark-mode .chat-input {
            color: #e4e6eb;
        }

        body.dark-mode .chat-input::placeholder {
            color: #b0b3b8;
        }

        body.dark-mode .chat-status-open {
            background: #4a3f0a;
            color: #ffc107;
        }

        body.dark-mode .chat-status-closed {
            background: #0a3622;
            color: #28a745;
        }

        body.dark-mode .chat-status-answered {
            background: #0a2540;
            color: #0084ff;
        }

        body.dark-mode .btn-close-ticket {
            border-color: #ff6b6b;
            color: #ff6b6b;
        }

        body.dark-mode .btn-close-ticket:hover {
            background: #ff6b6b;
            color: #18191a;
        }

        body.dark-mode .chat-closed-notice {
            color: #4ade80;
        }

        body.dark-mode .chat-messages::-webkit-scrollbar-thumb {
            background: #4e4f50;
        }

        body.dark-mode .chat-messages::-webkit-scrollbar-thumb:hover {
            background: #606162;
        }
    </style>
@endsection

@section('js')
    <script>
        // Auto-expand textarea
        const messageInput = document.getElementById('messageInput');
        if (messageInput) {
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 100) + 'px';
            });

            // Submit on Enter (but allow Shift+Enter for new line)
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('reply-form').submit();
                }
            });
        }

        // Scroll to bottom on load
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
@endsection
