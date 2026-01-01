@extends('layouts.error')
@section('title', '419')
@section('content')
<div class="row flex-grow">
    <div class="col-lg-7 mx-auto text-white">
        <div class="row align-items-center d-flex flex-row">
            <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0">419</h1>
            </div>
            <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2>PAGE EXPIRED</h2>
                <h3 class="fw-light">Session timed out!</h3>
            </div>
        </div>
        <div class="row mt-5 text-center">
            <div class="col-12">
                <a class="text-white fw-medium" href="{{ url()->previous() }}">Go back</a>
            </div>
        </div>
    </div>
</div>
@endsection
