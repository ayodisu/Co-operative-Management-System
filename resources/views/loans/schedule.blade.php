@extends('layouts.main')

@section('title', 'Repayment Schedule')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-primary">Repayment Schedule</h4>
                    <p class="card-description">
                        Official monthly breakdown for your active loan.
                    </p>

                    @if (isset($loan) && $loan)
                        @if ($loan->status == 'pending')
                            <div class="alert alert-warning border-0">
                                <i class="mdi mdi-clock-outline mr-2"></i>
                                <strong>Provisional Schedule:</strong> This loan is currently <strong>Pending</strong>. This
                                schedule is subject to change upon approval.
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mt-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Due Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Paid On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedule as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}</td>
                                            <td class="font-weight-bold">₦{{ number_format($item->amount, 2) }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = match ($item->status) {
                                                        'paid' => 'badge-success',
                                                        'pending' => 'badge-warning',
                                                        'overdue' => 'badge-danger',
                                                        default => 'badge-secondary',
                                                    };
                                                @endphp
                                                <label
                                                    class="badge {{ $badgeClass }}">{{ ucfirst($item->status) }}</label>
                                            </td>
                                            <td>{{ $item->paid_at ? \Carbon\Carbon::parse($item->paid_at)->format('d M Y') : '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="mdi mdi-clipboard-text-outline mdi-48px text-muted"></i>
                            </div>
                            <h5 class="text-secondary">No active loan found</h5>
                            <p class="text-muted">Once your loan is approved, your repayment schedule will appear here.</p>
                            <a href="{{ route('loans.apply') }}" class="btn btn-primary mt-2">Apply for a Loan</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
