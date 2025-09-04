@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <h2 class="fw-semibold fs-3 text-dark mb-4">
        {{ __('Profile Settings') }}
    </h2>

    <div class="row g-4 justify-content-center">

        {{-- Update Profile Information --}}
        <div class="col-12 col-md-8">
            <div class="card shadow-sm rounded-3 p-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div class="col-12 col-md-8">
            <div class="card shadow-sm rounded-3 p-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Delete User --}}
        <div class="col-12 col-md-8">
            <div class="card shadow-sm rounded-3 p-4 border-danger">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>
@endsection
