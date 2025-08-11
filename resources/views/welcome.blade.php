@extends('layouts.app')
@section('content')
<main class="py-5">

    {{-- Hero Section --}}
    <section class="hero py-5 text-center">
        <div class="container">
            <img src="{{ asset('assets/images/house.gif') }}" alt="house-icon" class="house-icon">

            <h1 class="display-4 fw-bold mt-3">Discover Your Next Getaway</h1>
            <p class="lead mb-4">Unique stays and unforgettable experiences around the world.</p>
            
            <form class="row justify-content-center g-2">
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-lg" placeholder="Where are you going?">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-lg w-100 text-white" style="background-color: #FF385C;">Search</button>
                </div>
            </form>
        </div>
    </section>


    {{-- Property Carousel --}}
    <section class="properties py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold">Featured Properties</h2>
                <div>
                    <button class="btn btn-outline-secondary btn-sm me-1" data-bs-target="#propertyCarousel" data-bs-slide="prev">&lt;</button>
                    <button class="btn btn-outline-secondary btn-sm" data-bs-target="#propertyCarousel" data-bs-slide="next">&gt;</button>
                </div>
            </div>

            <div id="propertyCarousel" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner">

                    {{-- Slide 1 --}}
                    <div class="carousel-item active">
                        <div class="row g-3">
                            @foreach ([
                                ['Beachside Villa', 'Miami, USA', '$250/night', 'ap1.jpg'],
                                ['City Apartment', 'Paris, France', '$180/night', 'ap2.jpg'],
                                ['Mountain Cabin', 'Aspen, USA', '$300/night', 'ap3.jpg']
                            ] as $property)
                                <div class="col-md-4">
                                    <a href="{{ url('/property-details') }}" class="text-decoration-none text-dark d-block h-100">
                                        <div class="card property-card border-0 shadow-sm">
                                            <img src="{{ asset('assets/apartments/' . $property[3]) }}" class="card-img-top" alt="{{ $property[0] }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $property[0] }}</h5>
                                                <p class="card-text text-muted mb-1">{{ $property[1] }}</p>
                                                <p class="fw-bold">{{ $property[2] }}</p>
                                                <div class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734; <span class="text-muted small">(120 reviews)</span></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Slide 2 --}}
                    <div class="carousel-item">
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

                </div>
            </div>
        </div>
    </section>
    <section class="properties py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold">Featured Properties</h2>
                <div>
                    <button class="btn btn-outline-secondary btn-sm me-1" data-bs-target="#propertyCarousel2" data-bs-slide="prev">&lt;</button>
                    <button class="btn btn-outline-secondary btn-sm" data-bs-target="#propertyCarousel2" data-bs-slide="next">&gt;</button>
                </div>
            </div>

            <div id="propertyCarousel2" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner">

                    {{-- Slide 1 --}}
                    <div class="carousel-item active">
                        <div class="row g-3">
                            @foreach ([
                                ['Beachside Villa', 'Miami, USA', '$250/night', 'ap1.jpg'],
                                ['City Apartment', 'Paris, France', '$180/night', 'ap2.jpg'],
                                ['Mountain Cabin', 'Aspen, USA', '$300/night', 'ap3.jpg']
                            ] as $property)
                                <div class="col-md-4">
                                    <a href="{{ url('/property-details') }}" class="text-decoration-none text-dark d-block h-100">
                                        <div class="card property-card border-0 shadow-sm">
                                            <img src="{{ asset('assets/apartments/' . $property[3]) }}" class="card-img-top" alt="{{ $property[0] }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $property[0] }}</h5>
                                                <p class="card-text text-muted mb-1">{{ $property[1] }}</p>
                                                <p class="fw-bold">{{ $property[2] }}</p>
                                                <div class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734; <span class="text-muted small">(120 reviews)</span></div>
                                            </div>
                                        </div>
                            </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Slide 2 --}}
                    <div class="carousel-item">
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

                </div>
            </div>
        </div>
    </section>
</main>

@endsection