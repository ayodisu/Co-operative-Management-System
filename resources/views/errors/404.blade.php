@extends('layouts.error')
@section('title', '404')
@section('content')
    <div class="row flex-grow">
        <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
                <div class="col-lg-6 text-lg-right pr-lg-4">
                    <h1 class="display-1 mb-0">404</h1>
                </div>
                <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                    <h2>NOT FOUND</h2>
                    <h3 class="fw-light">Page doesn’t exist!</h3>
                </div>
            </div>
            <div class="row mt-5 text-center">
                <div class="col-12">
                    <a class="text-white fw-medium"
                        href="{{ Auth::guard('admin')->check() ? route('admin.dashboard') : (Auth::check() ? route('user.dashboard') : url('/')) }}">Back
                        to home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
