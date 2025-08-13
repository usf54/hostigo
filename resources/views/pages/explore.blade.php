@extends('layouts.app')

@section('content')

  <!-- Filters -->
  <div class="filter-bar">
    <div class="container">
      <form class="row g-2 align-items-center">
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="Location">
        </div>
        <div class="col-md-3">
          <select class="form-select">
            <option value="">Property Type</option>
            <option>Apartment</option>
            <option>House</option>
            <option>Villa</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-select">
            <option value="">Price Range</option>
            <option>$50 - $100</option>
            <option>$100 - $200</option>
            <option>$200+</option>
          </select>
        </div>
        <div class="col-md-3 text-end">
          <button type="submit" class="btn btn-ff w-100">Search</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Properties Grid -->
  <div class="container my-4">
    <div class="row g-3">
        @foreach ([
            ['Lake House', 'Zurich, Switzerland', '$270/night', 'ap1.jpg'],
            ['Modern Loft', 'New York, USA', '$200/night', 'ap2.jpg'],
            ['Countryside Retreat', 'Tuscany, Italy', '$220/night', 'ap3.jpg']
        ] as $property)
            <div class="col-md-4">
                <a href="{{ url('/property-details') }}" class="text-decoration-none text-dark d-block h-100">
                <div class="card property-card border-0 shadow-sm">
                    <img src="{{ asset('assets/apartments/' . $property[3]) }}" class="card-img-top" alt="{{ $property[0] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property[0] }}</h5>
                        <p class="card-text text-muted mb-1">{{ $property[1] }}</p>
                        <p class="fw-bold">{{ $property[2] }}</p>
                        <div class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734; <span class="text-muted small">(98 reviews)</span></div>
                    </div>
                </div>
        </a>
            </div>
        @endforeach
    </div>
  </div>
@endsection
