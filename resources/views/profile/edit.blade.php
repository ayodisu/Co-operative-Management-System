@extends('layouts.modern')

@section('title', 'My Profile')

@section('content')
    <div class="animate-in max-w-5xl mx-auto">
        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Profile Settings</h1>
                <p class="page-description">Manage your account information and security preferences.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Left Side: Main Info --}}
            <div class="lg:col-span-8 space-y-8">
                {{-- Profile Information --}}
                <div class="card-modern p-6 md:p-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div
                            class="w-12 h-12 rounded-2xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <i data-lucide="user" class="w-6 h-6 text-primary"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-secondary-900 dark:text-white">Personal Information</h2>
                            <p class="text-sm text-secondary-500">Update your account's profile information and civil
                                service details.</p>
                        </div>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>

                {{-- Update Password --}}
                <div class="card-modern p-6 md:p-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div
                            class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <i data-lucide="key-round" class="w-6 h-6 text-amber-600"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-secondary-900 dark:text-white">Update Password</h2>
                            <p class="text-sm text-secondary-500">Ensure your account is using a long, random password to
                                stay secure.</p>
                        </div>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Right Side: Secondary Actions --}}
            <div class="lg:col-span-4 space-y-8">
                {{-- Delete Account --}}
                <div class="card-modern p-6 md:p-8 border-red-100 dark:border-red-900/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                            <i data-lucide="trash-2" class="w-6 h-6 text-red-600"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-red-700 dark:text-red-400">Danger Zone</h2>
                        </div>
                    </div>
                    <p class="text-sm text-secondary-600 dark:text-secondary-400 mb-6 leading-relaxed">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                    </p>
                    @include('profile.partials.delete-user-form')
                </div>

                {{-- Help Card --}}
                <div class="card-modern p-6 bg-secondary-50 dark:bg-secondary-800/50 border-none">
                    <h3 class="font-semibold text-secondary-900 dark:text-white mb-2 flex items-center gap-2">
                        <i data-lucide="help-circle" class="w-4 h-4 text-primary"></i>
                        Need assistance?
                    </h3>
                    <p class="text-sm text-secondary-600 dark:text-secondary-400 mb-4">
                        If you have questions about your profile or encounter any issues, please reach out to our support
                        team.
                    </p>
                    <a href="{{ route('support.index') }}" class="btn btn-secondary w-full">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
