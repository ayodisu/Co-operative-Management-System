<form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
    @csrf
    @method('PATCH')

    {{-- Basic Info Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2 p-4 bg-secondary-50 dark:bg-secondary-800/40 rounded-xl mb-2">
            <p class="text-sm font-semibold text-secondary-700 dark:text-secondary-300 uppercase tracking-wider mb-1">
                Account Credentials</p>
            <p class="text-xs text-secondary-500">Primary information used for login and notifications.</p>
        </div>

        <div>
            <label for="name" class="input-label">FullName</label>
            <div class="relative">
                <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
                <input type="text" class="input-modern pl-11 @error('name') border-red-500 @enderror" id="name"
                    name="name" value="{{ old('name', auth()->user()->name) }}" required autofocus>
            </div>
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="input-label">Email Address</label>
            <div class="relative">
                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400"></i>
                <input type="email" class="input-modern pl-11 @error('email') border-red-500 @enderror" id="email"
                    name="email" value="{{ old('email', auth()->user()->email) }}" required>
            </div>
            @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Civil Service Info Section --}}
    <div class="space-y-6">
        <div class="p-4 bg-secondary-50 dark:bg-secondary-800/40 rounded-xl mb-2">
            <p class="text-sm font-semibold text-secondary-700 dark:text-secondary-300 uppercase tracking-wider mb-1">
                Civil Service Information</p>
            <p class="text-xs text-secondary-500">Your professional details registered with the cooperative.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="phone" class="input-label">Phone Number</label>
                <input type="text" class="input-modern" id="phone" name="phone"
                    value="{{ old('phone', auth()->user()->profile->phone ?? '') }}" placeholder="Enter phone number">
            </div>

            <div>
                <label for="occupation" class="input-label">Occupation</label>
                <input type="text" class="input-modern" id="occupation" name="occupation"
                    value="{{ old('occupation', auth()->user()->profile->occupation ?? '') }}"
                    placeholder="Enter job title">
            </div>

            <div class="md:col-span-2">
                <label for="address" class="input-label">Home Address</label>
                <input type="text" class="input-modern" id="address" name="address"
                    value="{{ old('address', auth()->user()->profile->address ?? '') }}"
                    placeholder="Enter complete address">
            </div>

            <div>
                <label for="date_of_birth" class="input-label">Date of Birth</label>
                <input type="date" class="input-modern" id="date_of_birth" name="date_of_birth"
                    value="{{ old('date_of_birth', auth()->user()->profile->date_of_birth ?? '') }}">
            </div>

            <div>
                <label for="gender" class="input-label">Gender</label>
                <select name="gender" id="gender" class="input-modern">
                    <option value="">-- Select Gender --</option>
                    <option value="Male"
                        {{ old('gender', auth()->user()->profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                    </option>
                    <option value="Female"
                        {{ old('gender', auth()->user()->profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female
                    </option>
                </select>
            </div>

            <div>
                <label for="department" class="input-label">Department</label>
                <input type="text" class="input-modern" id="department" name="department"
                    value="{{ old('department', auth()->user()->profile->department ?? '') }}"
                    placeholder="e.g. Finance">
            </div>

            <div>
                <label for="date_of_appointment" class="input-label">Date of Appointment</label>
                <input type="date" class="input-modern" id="date_of_appointment" name="date_of_appointment"
                    value="{{ old('date_of_appointment', auth()->user()->profile->date_of_appointment ?? '') }}">
            </div>

            <div>
                <label for="grade_level" class="input-label">Grade Level</label>
                <input type="text" class="input-modern" id="grade_level" name="grade_level"
                    value="{{ old('grade_level', auth()->user()->profile->grade_level ?? '') }}" placeholder="e.g. 12">
            </div>

            <div>
                <label for="retirement_year" class="input-label">Expected Retirement Year</label>
                <input type="text" class="input-modern" id="retirement_year" name="retirement_year"
                    value="{{ old('retirement_year', auth()->user()->profile->retirement_year ?? '') }}"
                    placeholder="e.g. 2045">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-4 pt-4 border-t border-secondary-100 dark:border-secondary-800">
        <button type="submit" class="btn btn-primary px-8">
            <i data-lucide="save" class="w-4 h-4"></i>
            Save Changes
        </button>
    </div>
</form>
