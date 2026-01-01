@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-4 text-gray-800">Repayment History</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Repayments</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Member</th>
                                        <th>Loan ID</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($repayments as $repayment)
                                        <tr>
                                            <td>{{ $repayment->payment_date->format('d M, Y') }}</td>
                                            <td>{{ $repayment->loan->user->name ?? 'Unknown' }}</td>
                                            <td>#{{ $repayment->loan->id }}</td>
                                            <td class="text-success font-weight-bold">
                                                ₦{{ number_format($repayment->amount, 2) }}</td>
                                            <td>{{ $repayment->payment_method }}</td>
                                            <td>{{ $repayment->remarks ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No repayments recorded yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $repayments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
