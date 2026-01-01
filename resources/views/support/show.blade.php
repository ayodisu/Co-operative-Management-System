@extends('layouts.main')

@section('title', 'Support Ticket Details')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-1">Ticket #{{ $ticket->id }} - {{ $ticket->subject }}</h4>
                        <p class="text-muted mb-0 small">
                            Submitted {{ $ticket->created_at->format('M d, Y H:i') }}
                            <span class="mx-2">•</span>
                            Priority: <span
                                class="text-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority == 'medium' ? 'warning' : 'success') }}">{{ ucfirst($ticket->priority) }}</span>
                        </p>
                    </div>
                    <div>
                        @if ($ticket->status == 'open')
                            <span class="badge badge-warning">Open</span>
                        @elseif($ticket->status == 'replied')
                            <span class="badge badge-info">Replied</span>
                        @elseif($ticket->status == 'closed')
                            <span class="badge badge-success">Closed</span>
                        @endif
                    </div>
                </div>

                <div class="card-body bg-light" style="max-height: 500px; overflow-y: auto;">
                    <div class="d-flex flex-column gap-3">
                        {{-- Initial Ticket Description --}}
                        {{-- We might want to show the initial ticket body if it's not a message, but logic says messages[0] is body --}}

                        @foreach ($ticket->messages as $message)
                            <div
                                class="d-flex {{ $message->user_id === Auth::id() ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                                <div class="card {{ $message->user_id === Auth::id() ? 'bg-primary text-white' : 'bg-white' }}"
                                    style="max-width: 75%; border-radius: 15px; border-bottom-{{ $message->user_id === Auth::id() ? 'right' : 'left' }}-radius: 2px;">
                                    <div class="card-body p-3">
                                        <p class="mb-1">{!! nl2br(e($message->message)) !!}</p>
                                        <div class="text-{{ $message->user_id === Auth::id() ? 'light' : 'muted' }} small text-end"
                                            style="font-size: 0.75rem; opacity: 0.8;">
                                            {{ $message->user->name }} • {{ $message->created_at->format('M d, H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-footer bg-white py-3">
                    @if ($ticket->status !== 'closed')
                        <form method="POST" action="{{ route('support.reply', $ticket) }}">
                            @csrf
                            <div class="form-group mb-3">
                                <textarea name="message" class="form-control" rows="2" placeholder="Type your reply..." required
                                    style="resize: none;"></textarea>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('support.index') }}" class="btn btn-light text-muted"> <i
                                        class="mdi mdi-arrow-left"></i> Back</a>
                                <button class="btn btn-primary px-4" type="submit"> <i class="mdi mdi-send"></i> Send
                                    Reply</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-secondary mb-0 text-center">
                            This ticket is closed. <a href="{{ route('support.create') }}">Open a new one?</a>
                        </div>
                        <div class="mt-2 text-center">
                            <a href="{{ route('support.index') }}" class="btn btn-light">Back to Tickets</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
