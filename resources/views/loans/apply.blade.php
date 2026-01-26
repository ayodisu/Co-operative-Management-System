@extends('layouts.modern')

@section('title', 'Apply for Loan')

@section('content')
    <div class="animate-in max-w-2xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 mb-4">
                <i data-lucide="banknote" class="w-8 h-8 text-white"></i>
            </div>
            <h1 class="page-title">Apply for a Loan</h1>
            <p class="page-description">Fill out the form below to submit your loan application.</p>
        </div>

        {{-- Eligibility Info --}}
        <div class="card-modern p-6 mb-6 bg-primary-50 dark:bg-primary-900/20 border-primary-200 dark:border-primary-800">
            <div class="flex items-start gap-4">
                <div
                    class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="info" class="w-5 h-5 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-primary-700 dark:text-primary-300 mb-1">Your Loan Eligibility</h3>
                    <p class="text-sm text-primary-600 dark:text-primary-400">
                        Based on your monthly contribution of
                        <strong>₦{{ number_format($monthlyContribution, 2) }}</strong>,
                        you can borrow up to <strong>₦{{ number_format($loanLimit, 2) }}</strong> (30× your contribution).
                    </p>
                </div>
            </div>
        </div>

        {{-- Application Form --}}
        <div class="card-modern p-6">
            <form action="{{ route('loans.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Amount --}}
                <div>
                    <label for="amount" class="input-label">Loan Amount (₦)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-secondary-400 font-medium">₦</span>
                        <input type="number" name="amount" id="amount" class="input-modern pl-10"
                            placeholder="Enter amount" min="1000" max="{{ $loanLimit }}" value="{{ old('amount') }}"
                            required>
                    </div>
                    @error('amount')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Duration --}}
                <div>
                    <label for="duration_months" class="input-label">Repayment Duration</label>
                    <select name="duration_months" id="duration_months" class="input-modern" required>
                        <option value="">Select duration</option>
                        @for ($i = 1; $i <= 36; $i++)
                            <option value="{{ $i }}" {{ old('duration_months') == $i ? 'selected' : '' }}>
                                {{ $i }} {{ $i === 1 ? 'month' : 'months' }}
                            </option>
                        @endfor
                    </select>
                    @error('duration_months')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Purpose --}}
                <div>
                    <label for="purpose" class="input-label">Purpose of Loan</label>
                    <textarea name="purpose" id="purpose" rows="4" class="input-modern"
                        placeholder="Briefly describe why you need this loan..." required>{{ old('purpose') }}</textarea>
                    @error('purpose')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Terms & Conditions --}}
                <div class="p-4 bg-secondary-50 dark:bg-secondary-800 rounded-xl">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="agree"
                            class="mt-1 w-4 h-4 text-primary border-secondary-300 rounded focus:ring-primary" required>
                        <span class="text-sm text-secondary-600 dark:text-secondary-400">
                            I agree to the loan terms and conditions, including the repayment schedule.
                            I understand that failure to repay may result in penalties and affect my future loan
                            eligibility.
                        </span>
                    </label>
                    @error('agree')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary btn-lg flex-1">
                        <i data-lucide="send" class="w-5 h-5"></i>
                        Submit Application
                    </button>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary btn-lg">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
