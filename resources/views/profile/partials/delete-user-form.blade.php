<form method="POST" action="{{ route('profile.destroy') }}" class="space-y-6"
    onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
    @csrf
    @method('DELETE')

    <div>
        <label for="delete_password" class="input-label">Confirm Password</label>
        <input type="password" class="input-modern @error('password') border-red-500 @enderror" id="delete_password"
            name="password" placeholder="Enter password to confirm deletion" required>
        @error('password')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn btn-danger w-full">
        <i data-lucide="trash-2" class="w-4 h-4"></i>
        Permanently Delete Account
    </button>
</form>
