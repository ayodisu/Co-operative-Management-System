@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logodark.png') }}" alt="logo">
        </div>
        <h4>Hello! Let's get started</h4>
        <h6 class="fw-light">Sign in to continue.</h6>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="pt-3">
            @csrf

            {{-- Email Field --}}
            <div class="form-group">
                <input type="email" name="email"
                    class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1"
                    placeholder="Email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="form-group">
                <input type="password" name="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1"
                    placeholder="Password" required>
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                    SIGN IN
                </button>
            </div>

            {{-- Remember + Forgot --}}
            <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                        Keep me signed in
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
                @endif
            </div>



            {{-- Register --}}
            <div class="text-center mt-4 fw-light">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-primary">Create</a>
            </div>
        </form>
    </div>
@endsection
