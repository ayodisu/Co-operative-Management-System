@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logodark.png') }}" alt="logo">
        </div>
        <h4>Email Verification</h4>
        <h6 class="fw-light">Before proceeding, please check your email for a verification link.</h6>

        @if (session('status') === 'verification-link-sent')
            <div class="alert alert-success mt-3">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="pt-3">
            @csrf
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                    Resend Verification Email
                </button>
            </div>
        </form>

        <div class="text-center mt-4 fw-light">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="text-danger small">Logout</a>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf
            </form>
        </div>
    </div>
@endsection
