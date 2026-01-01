<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', auth()->user()->name) }}" required autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            value="{{ old('email', auth()->user()->email) }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <hr class="my-4">
    <h4 class="mb-3">Civil Service Information</h4>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone"
                value="{{ old('phone', auth()->user()->profile->phone ?? '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address"
                value="{{ old('address', auth()->user()->profile->address ?? '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="occupation" class="form-label">Occupation</label>
            <input type="text" class="form-control" id="occupation" name="occupation"
                value="{{ old('occupation', auth()->user()->profile->occupation ?? '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                value="{{ old('date_of_birth', auth()->user()->profile->date_of_birth ?? '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="">-- Select Gender --</option>
                <option value="Male"
                    {{ old('gender', auth()->user()->profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female"
                    {{ old('gender', auth()->user()->profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female
                </option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="date_of_appointment" class="form-label">Date of Appointment</label>
            <input type="date" class="form-control" id="date_of_appointment" name="date_of_appointment"
                value="{{ old('date_of_appointment', auth()->user()->profile->date_of_appointment ?? '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="grade_level" class="form-label">Grade Level</label>
            <input type="text" class="form-control" id="grade_level" name="grade_level"
                value="{{ old('grade_level', auth()->user()->profile->grade_level ?? '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" name="department"
                value="{{ old('department', auth()->user()->profile->department ?? '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="retirement_year" class="form-label">Retirement Year</label>
            <input type="text" class="form-control" id="retirement_year" name="retirement_year"
                value="{{ old('retirement_year', auth()->user()->profile->retirement_year ?? '') }}">
        </div>
    </div>


    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
    </div>
</form>
