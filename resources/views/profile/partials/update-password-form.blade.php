<form method="POST" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('PUT')

    <div>
        <label for="current_password" class="input-label">Current Password</label>
        <div class="relative">
            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
            <input type="password" class="input-modern pl-11 @error('current_password') border-red-500 @enderror"
                id="current_password" name="current_password" required placeholder="••••••••">
        </div>
        @error('current_password')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="input-label">New Password</label>
        <div class="relative">
            <i data-lucide="shield-check"
                class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
            <input type="password" class="input-modern pl-11 @error('password') border-red-500 @enderror" id="password"
                name="password" required placeholder="Minimum 8 characters">
        </div>
        @error('password')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="input-label">Confirm New Password</label>
        <div class="relative">
            <i data-lucide="shield-check"
                class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
            <input type="password" class="input-modern pl-11" id="password_confirmation" name="password_confirmation"
                required placeholder="Repeat new password">
        </div>
    </div>

    <div class="flex justify-end pt-2">
        <button type="submit" class="btn btn-primary px-8">
            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
            Update Password
        </button>
    </div>
</form>
