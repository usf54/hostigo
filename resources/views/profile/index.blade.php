@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row mb-5 align-items-center">

    {{-- Profile Picture --}}
    <div class="col-md-3 text-center">
      <img src="https://via.placeholder.com/150" alt="Profile Picture" class="rounded-circle img-fluid shadow" />
      <button class="btn btn-outline-primary mt-3 w-100">Change Photo</button>
    </div>

    {{-- User Info --}}
    <div class="col-md-9">
      <h2 class="fw-bold">John Doe</h2>
      <p class="mb-1"><strong>Email:</strong> john.doe@example.com</p>
      <p><strong>Phone:</strong> +1 234 567 890</p>
      <button class="btn btn-primary">Edit Profile</button>
    </div>
  </div>

  {{-- User Properties --}}
  <h4 class="mb-4">Your Properties</h4>
  <div class="row g-4">

    @foreach([
      ['Modern Apartment', 'New York, USA', '$200/night', 'https://via.placeholder.com/400x250?text=Apartment+1'],
      ['Cozy Cabin', 'Aspen, USA', '$150/night', 'https://via.placeholder.com/400x250?text=Cabin+2'],
      ['Beach Villa', 'Miami, USA', '$350/night', 'https://via.placeholder.com/400x250?text=Villa+3'],
      ['Downtown Loft', 'Chicago, USA', '$220/night', 'https://via.placeholder.com/400x250?text=Loft+4'],
    ] as $property)
      <div class="col-sm-6 col-lg-3">
        <div class="card h-100 shadow-sm rounded-3 overflow-hidden">
          <img src="{{ $property[3] }}" class="card-img-top" alt="{{ $property[0] }}" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">{{ $property[0] }}</h5>
            <p class="card-text text-muted mb-1">{{ $property[1] }}</p>
            <p class="fw-bold">{{ $property[2] }}</p>
          </div>
        </div>
      </div>
    @endforeach

  </div>
</div>

@endsection
