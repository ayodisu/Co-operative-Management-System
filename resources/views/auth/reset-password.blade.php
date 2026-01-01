@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logodark.png') }}" alt="logo">
        </div>
        <h4>Reset your password</h4>
        <h6 class="fw-light">Create a new secure password.</h6>

        <form method="POST" action="{{ route('password.update') }}" class="pt-3">
            @csrf

            {{-- Hidden Token --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email --}}
            <div class="form-group">
                <input type="email" name="email"
                    class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email"
                    value="{{ old('email', request()->email) }}" required>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="form-group">
                <input type="password" name="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="New Password"
                    required>
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control form-control-lg"
                    placeholder="Confirm Password" required>
            </div>

            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
@endsection
