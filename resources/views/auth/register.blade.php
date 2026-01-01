@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
        </div>
        <h4>New here?</h4>
        <h6 class="fw-light">Signing up is easy. It only takes a few steps</h6>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="pt-3">
            @csrf

            {{-- Username --}}
            <div class="form-group">
                <input type="text" name="name"
                    class="form-control form-control-lg @error('name') is-invalid @enderror" id="exampleInputUsername1"
                    placeholder="Username" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <input type="email" name="email"
                    class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1"
                    placeholder="Email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>



            {{-- Password --}}
            <div class="form-group">
                <input type="password" name="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1"
                    placeholder="Password" required autocomplete="new-password">
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control form-control-lg"
                    id="exampleInputPassword2" placeholder="Confirm Password" required autocomplete="new-password">
            </div>

            {{-- Terms Checkbox (optional logic) --}}
            <div class="mb-4">
                <div class="form-check">
                    <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="terms" required>
                        I agree to all Terms & Conditions
                    </label>
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-block btn-success btn-lg fw-medium auth-form-btn">
                    SIGN UP
                </button>
            </div>

            {{-- Link to Login --}}
            <div class="text-center mt-4 fw-light">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary">Login</a>
            </div>
        </form>
    </div>
@endsection
