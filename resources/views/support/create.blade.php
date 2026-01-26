@extends('layouts.modern')

@section('title', 'Contact Support')

@section('content')
    <div class="animate-in max-w-2xl mx-auto">
        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <a href="{{ route('support.index') }}"
                    class="inline-flex items-center gap-2 text-sm text-secondary-500 hover:text-primary mb-4 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Tickets
                </a>
                <h1 class="page-title">Need Help?</h1>
                <p class="page-description">Fill out the form below and our team will respond shortly.</p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="card-modern p-6 md:p-8">
            <form action="{{ route('support.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="subject" class="input-label">Subject</label>
                    <input type="text" name="subject" id="subject"
                        class="input-modern @error('subject') border-red-500 @enderror"
                        placeholder="e.g. Issue with loan application" required value="{{ old('subject') }}">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="input-label">Priority Level</label>
                    <select name="priority" id="priority" class="input-modern @error('priority') border-red-500 @enderror"
                        required>
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low - Non-urgent inquiry
                        </option>
                        <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium - Normal
                            assistance</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High - Urgent issue
                        </option>
                    </select>
                    @error('priority')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="input-label">Message Details</label>
                    <textarea name="message" id="message" rows="6" class="input-modern @error('message') border-red-500 @enderror"
                        placeholder="Please describe your issue in detail so we can help you better..." required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="btn btn-primary flex-1">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        Submit Ticket
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
