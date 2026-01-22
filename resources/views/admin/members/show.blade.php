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
                    <div class="card-header py-3">
                        <ul class="nav nav-tabs card-header-tabs" id="memberTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details"
                                    role="tab">Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="savings-tab" data-toggle="tab" href="#savings"
                                    role="tab">Savings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="loans-tab" data-toggle="tab" href="#loans" role="tab">Loans</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="memberTabContent">
                            {{-- Details Tab --}}
                            <div class="tab-pane fade show active" id="details" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="font-weight-bold">Member Information</h5>
                                    <a href="{{ route('admin.members.edit', $member->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-account-edit mr-1"></i> Edit Profile
                                    </a>
                                </div>
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
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 font-weight-bold">Monthly Contribution:</div>
                                    <div class="col-sm-8">
                                        ₦{{ number_format($member->profile->monthly_contribution ?? 0, 2) }}</div>
                                </div>
                                <div class="row mb-3 text-success">
                                    <div class="col-sm-4 font-weight-bold">Total Savings:</div>
                                    <div class="col-sm-8 font-weight-bold">
                                        ₦{{ number_format($member->profile->total_contributions ?? 0, 2) }}</div>
                                </div>
                            </div>

                            {{-- Savings Tab --}}
                            <div class="tab-pane fade" id="savings" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="font-weight-bold">Savings Management</h5>
                                    <a href="{{ route('reports.savings', $member->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="mdi mdi-file-pdf"></i> Statement
                                    </a>
                                </div>

                                {{-- Quick Transaction Form --}}
                                <div class="card bg-light mb-4">
                                    <div class="card-body">
                                        <h6>Record Transaction</h6>
                                        <form action="{{ route('admin.savings.store', $member->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="type" class="form-control" required>
                                                        <option value="deposit">Deposit</option>
                                                        <option value="withdrawal">Withdrawal</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" name="amount" class="form-control"
                                                        placeholder="Amount" step="0.01" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="description" class="form-control"
                                                        placeholder="Description (Optional)">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-success w-100">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <h6>Recent Transactions</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($member->savingsTransactions as $st)
                                                <tr>
                                                    <td>{{ $st->created_at->format('d/m/y') }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $st->type == 'deposit' ? 'success' : ($st->type == 'withdrawal' ? 'danger' : 'info') }}">{{ ucfirst($st->type) }}</span>
                                                    </td>
                                                    <td>₦{{ number_format($st->amount, 2) }}</td>
                                                    <td>₦{{ number_format($st->balance_after, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No transactions</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Loans Tab --}}
                            <div class="tab-pane fade" id="loans" role="tabpanel">
                                <h5 class="font-weight-bold mb-4">Loan History</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Remaining</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($member->loans as $loan)
                                                <tr>
                                                    <td>#{{ $loan->id }}</td>
                                                    <td>₦{{ number_format($loan->amount, 2) }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $loan->status == 'approved' ? 'success' : ($loan->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($loan->status) }}</span>
                                                    </td>
                                                    <td>₦{{ number_format($loan->balance_remaining, 2) }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.loans.show', $loan->id) }}"
                                                            class="btn btn-xs btn-info">View</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No loans</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
