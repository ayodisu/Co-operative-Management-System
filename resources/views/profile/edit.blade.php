@extends('layouts.main')

@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="text-dark">Profile</h2>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Profile Information</h5>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Password</h5>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-danger">Delete Account</h5>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
