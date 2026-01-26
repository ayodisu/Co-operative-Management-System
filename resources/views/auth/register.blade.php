@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="card-modern p-8 shadow-xl">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-secondary-900 dark:text-white mb-1">Join us today</h2>
            <p class="text-secondary-500 dark:text-secondary-400">Signing up is easy. It only takes a few steps.</p>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            {{-- Full Name --}}
            <div>
                <label for="name" class="input-label">Full Name</label>
                <div class="relative">
                    <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400"></i>
                    <input type="text" id="name" name="name"
                        class="input-modern pl-12 @error('name') border-red-500 @enderror" placeholder="John Doe"
                        value="{{ old('name') }}" required autofocus>
                </div>
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="input-label">Email Address</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400"></i>
                    <input type="email" id="email" name="email"
                        class="input-modern pl-12 @error('email') border-red-500 @enderror" placeholder="you@example.com"
                        value="{{ old('email') }}" required autocomplete="username">
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="input-label">Password</label>
                <div class="relative">
                    <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400"></i>
                    <input type="password" id="password" name="password"
                        class="input-modern pl-12 @error('password') border-red-500 @enderror" placeholder="••••••••"
                        required autocomplete="new-password">
                </div>
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="password_confirmation" class="input-label">Confirm Password</label>
                <div class="relative">
                    <i data-lucide="shield-check"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="input-modern pl-12" placeholder="••••••••" required autocomplete="new-password">
                </div>
            </div>

            {{-- Terms Checkbox --}}
            <label class="flex items-center gap-3 cursor-pointer group py-2">
                <input type="checkbox" name="terms" required
                    class="w-5 h-5 text-primary border-secondary-300 rounded focus:ring-primary">
                <span class="text-sm text-secondary-600 dark:text-secondary-400">
                    I agree to the <a href="#" class="text-primary hover:underline font-medium">Terms & Conditions</a>
                </span>
            </label>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-full py-3.5 text-lg shadow-lg shadow-primary/20">
                <i data-lucide="user-plus" class="w-5 h-5 mr-1"></i>
                Create Account
            </button>

            {{-- Link to Login --}}
            <div class="text-center pt-6 border-t border-secondary-100 dark:border-secondary-800">
                <p class="text-sm text-secondary-600 dark:text-secondary-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-bold text-primary hover:text-primary-700 transition-colors">
                        Sign In
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection
