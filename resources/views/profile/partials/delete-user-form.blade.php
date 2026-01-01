<form method="POST" action="{{ route('profile.destroy') }}"
      onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
    @csrf
    @method('DELETE')

    <p class="text-danger mb-3">
        Once your account is deleted, all of its resources and data will be permanently deleted.
    </p>

    <div class="mb-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password"
               class="form-control @error('password') is-invalid @enderror"
               id="password"
               name="password"
               required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-danger">Delete Account</button>
</form>
