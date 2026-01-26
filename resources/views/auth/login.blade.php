@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="card-modern p-8 shadow-xl">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-secondary-900 dark:text-white mb-1">Welcome back</h2>
            <p class="text-secondary-500 dark:text-secondary-400">Please enter your details to sign in.</p>
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

        @if (session('status'))
            <div
                class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="input-label">Email Address</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400"></i>
                    <input type="email" id="email" name="email" class="input-modern pl-12"
                        placeholder="you@example.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            {{-- Password --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="input-label mb-0">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-primary hover:text-primary-700 transition-colors">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400"></i>
                    <input type="password" id="password" name="password" class="input-modern pl-12" placeholder="••••••••"
                        required>
                </div>
            </div>

            {{-- Remember Me --}}
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox" name="remember"
                    class="w-5 h-5 text-primary border-secondary-300 rounded focus:ring-primary">
                <span
                    class="text-sm text-secondary-600 dark:text-secondary-400 group-hover:text-secondary-900 transition-colors">Keep
                    me signed in</span>
            </label>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-full py-3 text-lg">
                <i data-lucide="log-in" class="w-5 h-5 mr-1"></i>
                Sign In
            </button>

            {{-- Register Link --}}
            <div class="text-center pt-4 border-t border-secondary-100 dark:border-secondary-800">
                <p class="text-sm text-secondary-600 dark:text-secondary-400">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                        class="font-bold text-primary hover:text-primary-700 transition-colors">
                        Create Account
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection
