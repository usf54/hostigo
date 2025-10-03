@extends('layouts.app')

@section('title', 'My Properties')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1" style="color: #FF385C;">My Properties</h2>
      <p class="text-muted mb-0">Manage your listings and keep them up to date</p>
    </div>
    <a href="{{ route('property.create') }}" class="btn btn-primary px-4" style="background-color: #FF385C; border: none;">
      + Add New Property
    </a>
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
@endsection
