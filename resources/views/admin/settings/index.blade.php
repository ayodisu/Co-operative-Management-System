@extends('layouts.modern')

@section('title', 'System Settings')

@section('content')
    <div class="animate-in max-w-4xl mx-auto">
        {{-- Page Header --}}
        <div class="page-header">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center">
                    <i data-lucide="settings-2" class="w-6 h-6 text-secondary-600 dark:text-secondary-400"></i>
                </div>
                <div>
                    <h1 class="page-title">System Settings</h1>
                    <p class="page-description">Configure global parameters and business rules.</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div
                class="mb-8 p-4 bg-success-50 dark:bg-success-900/20 border border-success-100 dark:border-success-900/20 rounded-2xl flex items-center gap-3 text-success-700 dark:text-success-400">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Left column for sections --}}
            <div class="md:col-span-1 space-y-4">
                <div class="card-modern p-2">
                    <button
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white shadow-lg shadow-primary/20">
                        <i data-lucide="percent" class="w-4 h-4"></i>
                        <span class="text-sm font-bold">Loan Policy</span>
                    </button>
                    <button
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-secondary-600 dark:text-secondary-400 hover:bg-secondary-50 dark:hover:bg-secondary-800 transition-colors mt-1">
                        <i data-lucide="user-cog" class="w-4 h-4"></i>
                        <span class="text-sm font-bold">Admin Account</span>
                    </button>
                    <button
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-secondary-600 dark:text-secondary-400 hover:bg-secondary-50 dark:hover:bg-secondary-800 transition-colors mt-1">
                        <i data-lucide="shield" class="w-4 h-4"></i>
                        <span class="text-sm font-bold">Security</span>
                    </button>
                    <button
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-secondary-600 dark:text-secondary-400 hover:bg-secondary-50 dark:hover:bg-secondary-800 transition-colors mt-1">
                        <i data-lucide="mail-plus" class="w-4 h-4"></i>
                        <span class="text-sm font-bold">Notifications</span>
                    </button>
                </div>

                <div class="card-modern p-6 bg-secondary-900 text-white relative overflow-hidden group">
                    <div
                        class="absolute -top-10 -right-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl group-hover:bg-primary/30 transition-all">
                    </div>
                    <div class="relative z-10">
                        <h4 class="text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Pro Tip</h4>
                        <p class="text-xs text-secondary-300 leading-relaxed">
                            Interest rate changes only apply to NEW loan applications. Existing loans remain on their
                            original rate.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right column for the actual form --}}
            <div class="md:col-span-2">
                <div class="card-modern">
                    <div class="p-6 border-b border-secondary-100 dark:border-secondary-800">
                        <h3 class="font-bold text-secondary-900 dark:text-white">Loan & Communication Config</h3>
                    </div>

                    <form action="{{ route('admin.settings.update') }}" method="POST" class="p-8 space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="interest_rate" class="input-label">Annual Interest Rate (%)</label>
                                <div class="relative">
                                    <i data-lucide="percent"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
                                    <input type="number" step="0.01" id="interest_rate" name="interest_rate"
                                        class="input-modern pl-12" placeholder="5.5"
                                        value="{{ \App\Models\Setting::getValue('interest_rate', 5.5) }}" required>
                                </div>
                                <p class="mt-2 text-[10px] font-medium text-secondary-400">Global rate for all new loans.
                                </p>
                            </div>

                            <div>
                                <label for="max_loan_term" class="input-label">Max. Loan Term (Months)</label>
                                <div class="relative">
                                    <i data-lucide="calendar"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
                                    <input type="number" id="max_loan_term" name="max_loan_term" class="input-modern pl-12"
                                        placeholder="12" value="{{ \App\Models\Setting::getValue('max_loan_term', 12) }}"
                                        required>
                                </div>
                                <p class="mt-2 text-[10px] font-medium text-secondary-400">Maximum repayment duration.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="min_monthly_repayment" class="input-label">Min. Monthly Repayment (%)</label>
                                <div class="relative">
                                    <i data-lucide="trending-down"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
                                    <input type="number" step="0.01" id="min_monthly_repayment"
                                        name="min_monthly_repayment" class="input-modern pl-12" placeholder="10"
                                        value="{{ \App\Models\Setting::getValue('min_monthly_repayment', 10) }}" required>
                                </div>
                                <p class="mt-2 text-[10px] font-medium text-secondary-400">Minimum monthly capital recovery.
                                </p>
                            </div>

                            <div>
                                <label for="support_email" class="input-label">Global Support Email</label>
                                <div class="relative">
                                    <i data-lucide="mail"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
                                    <input type="email" id="support_email" name="support_email" class="input-modern pl-12"
                                        placeholder="support@example.com"
                                        value="{{ \App\Models\Setting::getValue('support_email', 'support@example.com') }}"
                                        required>
                                </div>
                                <p class="mt-2 text-[10px] font-medium text-secondary-400">Used for system notifications.
                                </p>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-secondary-100 dark:border-secondary-800 flex justify-end">
                            <button type="submit" class="btn btn-primary px-10 py-3.5 shadow-xl shadow-primary/20">
                                <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                                Save Configuration
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
