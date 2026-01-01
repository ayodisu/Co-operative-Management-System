@extends('layouts.main')

@section('title', 'System Settings')

@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">System Configuration</h4>
                    <p class="card-description"> Manage global application settings. </p>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form class="forms-sample" action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="interest_rate">Interest Rate (%)</label>
                            <input type="number" step="0.01" class="form-control" id="interest_rate"
                                name="interest_rate" placeholder="5.5"
                                value="{{ \App\Models\Setting::getValue('interest_rate', 5.5) }}" required>
                            <small class="form-text text-muted">Annual interest rate for loans.</small>
                        </div>

                        <div class="form-group">
                            <label for="max_loan_term">Maximum Loan Term (Months)</label>
                            <input type="number" class="form-control" id="max_loan_term" name="max_loan_term"
                                placeholder="12" value="{{ \App\Models\Setting::getValue('max_loan_term', 12) }}" required>
                            <small class="form-text text-muted">Maximum duration for loan repayment.</small>
                        </div>

                        <div class="form-group">
                            <label for="min_monthly_repayment">Min. Monthly Repayment (%)</label>
                            <input type="number" step="0.01" class="form-control" id="min_monthly_repayment"
                                name="min_monthly_repayment" placeholder="10"
                                value="{{ \App\Models\Setting::getValue('min_monthly_repayment', 10) }}" required>
                            <small class="form-text text-muted">Minimum percentage of salary/contribution?</small>
                        </div>

                        <div class="form-group">
                            <label for="support_email">Support Email</label>
                            <input type="email" class="form-control" id="support_email" name="support_email"
                                placeholder="support@example.com"
                                value="{{ \App\Models\Setting::getValue('support_email', 'support@example.com') }}"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
