@extends('layouts.main')

@section('title', 'Apply for Loan')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-primary mb-4">Loan Application</h3>
                    <div class="alert alert-info border-0 bg-light-primary">
                        <i class="mdi mdi-information-outline mr-2"></i>
                        <strong>Eligibility Check:</strong> Based on your monthly contribution of
                        <strong>₦{{ number_format($monthlyContribution, 2) }}</strong>, your maximum loan limit is:
                        <h4 class="mt-2 text-primary font-weight-bold">₦{{ number_format($loanLimit, 2) }}</h4>
                    </div>

                    {{-- Success Message --}}
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- General Error Message --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('loans.store') }}" class="forms-sample mt-4">
                        @csrf

                        {{-- Loan Amount --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Amount (₦)</label>
                            <input type="number" name="amount" class="form-control" value="{{ old('amount') }}"
                                min="1000" step="1000" placeholder="e.g. 50000" required />
                            @error('amount')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Duration --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Duration</label>
                            <select name="duration_months" class="form-control">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('duration_months', 12) == $i ? 'selected' : '' }}>{{ $i }}
                                        Month{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                                <option value="18" {{ old('duration_months') == 18 ? 'selected' : '' }}>18 Months
                                </option>
                                <option value="24" {{ old('duration_months') == 24 ? 'selected' : '' }}>24 Months
                                </option>
                                <option value="36" {{ old('duration_months') == 36 ? 'selected' : '' }}>36 Months
                                </option>
                            </select>
                            <small class="text-muted mt-2 d-block">Select repayment period (Max 36 months)</small>
                            @error('duration_months')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Purpose --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Purpose</label>
                            <textarea name="purpose" class="form-control" rows="4" placeholder="Briefly describe why you need this loan..."
                                required>{{ old('purpose') }}</textarea>
                            @error('purpose')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Agreement Checkbox --}}
                        <div class="form-check form-check-flat form-check-primary mt-4 mb-4">
                            <label class="form-check-label">
                                <input type="checkbox" name="agree" class="form-check-input" required />
                                I acknowledge that this application is subject to approval based on my current contribution
                                standing.
                            </label>
                            @error('agree')
                                <span class="text-danger small d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-light btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
