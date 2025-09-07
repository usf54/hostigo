@extends('layouts.app')

@section('content')
<div class="container py-5">
   @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
  <div class="row mb-5 align-items-center">

    {{-- Profile Picture --}}
    <div class="col-md-3 text-center">
      <div class="profile-pic-wrapper" style="position: relative; display: inline-block; cursor: pointer;" onclick="fileLoad()">
        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.jpg') }}" 
            alt="Profile Picture" 
            style="border-radius: 100%; width: 190px; height: 170px; object-fit: cover;"/>

        {{-- Overlay --}}
        <div class="overlay" 
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                   border-radius: 100%; background: rgba(0,0,0,0.5); color: #fff;
                   display: flex; align-items: center; justify-content: center;
                   font-weight: bold; font-size: 16px; opacity: 0; transition: opacity 0.3s;">
          Update Photo
        </div>
      </div>

      {{-- Photo Upload Form --}}
      <form action="{{ route('guest.profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="mt-3" id="photoForm">
          @csrf
          <input type="file" name="image" class="form-control mb-2" accept="image/*" required hidden id="pictureInput" onchange="document.getElementById('photoForm').submit();">
      </form>
    </div>

    {{-- User Info --}}
    <div class="col-md-9">
      <h2 class="fw-bold">{{ Auth::user()->name }}</h2>
      <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email }}</p>
      <p><strong>Phone:</strong> {{ Auth::user()->phone ?? '-' }}</p>
      <button class="btn btn-primary">
        <a href="{{ route('guest.profile.edit') }}" class="nav-link text-white p-0">Edit Profile</a>
      </button>
      <p class="mt-2 text-muted">Joined {{ Auth::user()->created_at->format('F Y') }}</p>
    </div>
  </div>

  {{-- Guest Reservations --}}
  <div class="row g-4 mt-4">
    <h1>My Reservations</h1>
      @forelse($bookings as $booking)
        <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm rounded-4">
            @if($booking->property && $booking->property->images->isNotEmpty())
              <img src="{{ asset('storage/'.$booking->property->images->first()->image_url) }}" class="card-img-top">
            @endif
            <div class="card-body">
              <h5 class="fw-bold">{{ $booking->property->title ?? 'Property Title' }}</h5>
              <p class="text-muted">{{ $booking->check_in }} - {{ $booking->check_out }}</p>
              <p>Status: <strong>{{ ucfirst($booking->status) }}</strong></p>

              <a href="{{ route('guest.bookings.show', $booking->id) }}" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center text-muted">
          <p>You haven’t made any reservations yet.</p>
        </div>
      @endforelse
  </div>
</div>

<script>
  function fileLoad() {
    document.getElementById('pictureInput').click();
  }

  // Show overlay on hover
  document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.querySelector(".profile-pic-wrapper");
    const overlay = wrapper.querySelector(".overlay");

    wrapper.addEventListener("mouseenter", () => overlay.style.opacity = "1");
    wrapper.addEventListener("mouseleave", () => overlay.style.opacity = "0");
  });
</script>
@endsection
