@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Member: {{ $member->name }}</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.members.update', $member->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <h6 class="heading-small text-muted mb-4">User Information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $member->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Email Address</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $member->email) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Phone Number</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $member->profile->phone ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Address</label>
                                    <textarea name="address" class="form-control" rows="3">{{ old('address', $member->profile->address ?? '') }}</textarea>
                                </div>
                            </div>

                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-4">Financial Details (Admin Only)</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Monthly Contribution (Savings)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₦</span>
                                                </div>
                                                <input type="number" step="0.01" name="monthly_contribution"
                                                    class="form-control"
                                                    value="{{ old('monthly_contribution', $member->profile->monthly_contribution ?? 0) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Total Contributions (Equity)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₦</span>
                                                </div>
                                                <input type="number" step="0.01" name="total_contributions"
                                                    class="form-control"
                                                    value="{{ old('total_contributions', $member->profile->total_contributions ?? 0) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <a href="{{ route('admin.members.show', $member->id) }}"
                                    class="btn btn-secondary mr-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
