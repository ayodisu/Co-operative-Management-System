@extends('layouts.main')

@section('title', 'Support Tickets')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Support Tickets</h4>
                    <p class="card-description"> Review and respond to support requests </p>
                    <div class="mb-3">
                        <a href="{{ route('support.create') }}" class="btn btn-primary">Open New Ticket</a>
                    </div>

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
                                                <label class="badge badge-warning">Open</label>
                                            @elseif($ticket->status == 'replied')
                                                <label class="badge badge-info">Replied</label>
                                            @elseif($ticket->status == 'closed')
                                                <label class="badge badge-success">Closed</label>
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($ticket->priority) }}</td>
                                        <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                        <td><a href="{{ route('support.show', $ticket) }}"
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
