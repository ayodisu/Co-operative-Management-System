@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <img src="{{ $member->profile->avatar ?? asset('images/default-avatar.png') }}"
                            class="rounded-circle img-fluid mb-3" style="width: 150px;">

                        <h5 class="font-weight-bold">{{ $member->name }}</h5>
                        <p class="text-muted">{{ $member->email }}</p>
                        <span class="badge badge-{{ $member->status == 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($member->status ?? 'Active') }}
                        </span>
                        <hr>
                        <div class="mt-4">
                            <form action="{{ route('admin.members.suspend', $member->id) }}" method="POST" class="mb-2">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="btn {{ $member->status === 'suspended' ? 'btn-success' : 'btn-warning' }} w-100">
                                    <i
                                        class="mdi {{ $member->status === 'suspended' ? 'mdi-account-check' : 'mdi-account-off' }} mr-2"></i>
                                    {{ $member->status === 'suspended' ? 'Reactivate' : 'Suspend Member' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this member?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="mdi mdi-delete mr-2"></i>
                                    Delete Member
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Member Details</h6>

                        <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-account-edit mr-1"></i> Edit Profile
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Phone Number:</div>
                            <div class="col-sm-8">{{ $member->profile->phone ?? 'Not set' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Address:</div>
                            <div class="col-sm-8">{{ $member->profile->address ?? 'No address provided' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Bio:</div>
                            <div class="col-sm-8">{{ $member->profile->bio ?? 'No bio available' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Joined On:</div>
                            <div class="col-sm-8">{{ $member->created_at->format('F d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
