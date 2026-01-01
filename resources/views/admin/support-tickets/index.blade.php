@extends('layouts.main')

@section('title', 'Support Tickets')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Support Tickets</h4>
                    <p class="card-description"> Review and respond to support requests </p>

                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Submitted</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tickets as $ticket)
                                    <tr>
                                        <td>{{ Str::limit($ticket->subject, 50) }}</td>
                                        <td>
                                            @if ($ticket->status == 'open')
                                                <label class="badge ticket-badge-open">Open</label>
                                            @elseif($ticket->status == 'answered')
                                                <label class="badge ticket-badge-answered">Answered</label>
                                            @elseif($ticket->status == 'closed')
                                                <label class="badge ticket-badge-closed">Closed</label>
                                            @else
                                                <label
                                                    class="badge ticket-badge-default">{{ ucfirst($ticket->status) }}</label>
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($ticket->priority) }}</td>
                                        <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                        <td><a href="{{ route('admin.support.show', $ticket) }}"
                                                class="btn btn-sm btn-primary">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No tickets found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endsection

@section('css')
    <style>
        /* Ticket Status Badges */
        .ticket-badge-open {
            background-color: #f59e0b;
            color: #ffffff;
        }

        .ticket-badge-answered {
            background-color: #3b5fdf;
            color: #ffffff;
        }

        .ticket-badge-closed {
            background-color: #10b981;
            color: #ffffff;
        }

        .ticket-badge-default {
            background-color: #6b7280;
            color: #ffffff;
        }

        /* Dark Mode Badge Overrides */
        body.dark-mode .ticket-badge-open {
            background-color: #d97706;
            color: #ffffff;
        }

        body.dark-mode .ticket-badge-answered {
            background-color: #4f6fdf;
            color: #ffffff;
        }

        body.dark-mode .ticket-badge-closed {
            background-color: #059669;
            color: #ffffff;
        }

        body.dark-mode .ticket-badge-default {
            background-color: #9ca3af;
            color: #1e1e1e;
        }
    </style>
@endsection
