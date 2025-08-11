@extends('layouts.app')

@section('content')
    {{-- Header --}}
    <div class="container py-4">
        <h2 class="fw-semibold fs-3 text-dark mb-4">
            {{ __('Profile Settings') }}
        </h2>

        <div class="row g-4">

            {{-- Update Profile Information --}}
            <div class="col-12">
                <div class="card shadow-sm rounded-3 p-4 bg-white">
                    <div class="mx-auto" style="max-width: 640px;">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Update Password --}}
            <div class="col-12">
                <div class="card shadow-sm rounded-3 p-4 bg-white">
                    <div class="mx-auto" style="max-width: 640px;">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- Delete User --}}
            <div class="col-12">
                <div class="card shadow-sm rounded-3 p-4 bg-white">
                    <div class="mx-auto" style="max-width: 640px;">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
