@extends('layouts.app')

@section('title', 'Confirm Password')

@section('content')
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logodark.png') }}" alt="logo">
        </div>
        <h4>Secure Area</h4>
        <h6 class="fw-light">
            Please confirm your password before continuing.
        </h6>

        <form method="POST" action="{{ route('password.confirm') }}" class="pt-3">
            @csrf

            {{-- Password --}}
            <div class="form-group">
                <input type="password" name="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1"
                    placeholder="Password" required autocomplete="current-password">
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                    Confirm Password
                </button>
            </div>
        </form>

        {{-- Optional: Back to home or dashboard --}}
        <div class="text-center mt-4 fw-light">
            <a href="{{ route('user.dashboard') }}" class="text-primary">Back to Dashboard</a>
        </div>
    </div>
@endsection
