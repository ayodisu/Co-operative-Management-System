@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logodark.png') }}" alt="logo">
        </div>
        <h4>Forgot your password?</h4>
        <h6 class="fw-light">Enter your email and we’ll send you a reset link.</h6>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="pt-3">
            @csrf

            <div class="form-group">
                <input type="email" name="email"
                    class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                    Send Reset Link
                </button>
            </div>

            <div class="text-center mt-4 fw-light">
                <a href="{{ route('login') }}" class="text-primary">Back to Login</a>
            </div>
        </form>
    </div>
@endsection
