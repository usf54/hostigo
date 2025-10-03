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

    <div class="col-md-3 text-center">
        <div
            class="profile-pic-wrapper"
            style="position: relative; display: inline-block; cursor: pointer;"
            role="button"
            tabindex="0"
            onclick="fileLoad()"
            onkeydown="if(event.key==='Enter'||event.key===' '){ fileLoad(); event.preventDefault(); }"
            aria-label="Update Profile"
        >
            <img src="{{ asset('storage/'.$user->image) }}"
                alt="Profile"
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

        <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="mt-3" id="photoForm">
            @csrf
            <input type="file" name="image" class="form-control mb-2" accept="image/*" required hidden id='pictureInput' onchange="document.getElementById('photoForm').submit();">
        </form>
    </div>



    {{-- User Info --}}
    <div class="col-md-9">
      <h2 class="fw-bold">{{ ucfirst($user->name) }}</h2>
      <p class="mb-1"><strong>Email:</strong> {{$user->email}}</p>
      <p><strong>Phone:</strong> {{$user->phone}}</p>
      <button class="btn btn-primary"><a href="{{ route('profile.edit') }}" class="nav-link">Edit Profile</a></button>
    </div>
  </div>

  <div class="row g-4">
      @forelse($properties as $property)
        <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm rounded-4">
            @if ($property->images->isNotEmpty())
              <img src="{{ asset('storage/'.$property->images->first()->image_url)}}" class="card-img-top" alt="property">
            @endif
            <div class="card-body">
              <h5 class="fw-bold">{{ $property->title }}</h5>
              <p class="text-muted">{{ $property->city }}, {{ $property->country }}</p>
              <p>${{ $property->price_per_night }} / night</p>
              
              <a href="{{ route('property.show', $property->id) }}" class="btn btn-primary">View</a>
              <a href="{{ route('property.edit', $property->id) }}" class="btn btn-outline-warning">Edit</a>
              <form action="{{ route('property.destroy', $property->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center text-muted">
          <p>You haven’t listed any properties yet.</p>
          <a href="{{ route('property.create') }}" class="btn btn-primary">Add Your First Property</a>
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
