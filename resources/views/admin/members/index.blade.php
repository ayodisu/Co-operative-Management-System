@extends('layouts.main')

@section('title', 'Member Management')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cooperative Members</h4>
            <p class="card-description">List of all registered members and their current status</p>
            
            <div class="table-responsive">
                <table class="table table-hover" id="membersTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Monthly Contribution</th>
                            <th>Total Savings</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>
                                    <strong>{{ $member->name }}</strong><br>
                                    <small class="text-muted">{{ $member->email }}</small>
                                </td>
                                <td>{{ $member->profile->department ?? 'Not Set' }}</td>
                                <td>₦{{ number_format($member->profile->monthly_contribution ?? 0, 2) }}</td>
                                <td>₦{{ number_format($member->profile->total_contributions ?? 0, 2) }}</td>
                                <td>
                                    <a href="{{ route('admin.members.show', $member->id) }}" class="btn btn-info btn-sm">View Profile</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#membersTable').DataTable();
    });
</script>
@endsection