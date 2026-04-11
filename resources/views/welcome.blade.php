@extends('layouts.app')
@section('content')
<main class="py-5">

    {{-- Hero Section --}}
    <section class="hero py-5 text-center">
        <div class="container">
            <img src="{{ asset('assets/images/house.gif') }}" alt="house-icon" class="house-icon">
            <h1 class="display-4 fw-bold mt-3">Discover Your Next Getaway</h1>
            <p class="lead mb-4">Unique stays and unforgettable experiences around the world.</p>

            <form class="row justify-content-center g-2" method="GET" action="{{ route('public.properties') }}">
                <div class="col-md-6">
                    <input 
                        type="text"
                        name="location"
                        value="{{ request('location') }}"
                        class="form-control form-control-lg"
                        placeholder="Where are you going?">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-lg w-100 text-white" style="background-color: #FF385C;">Search</button>
                </div>
            </form>
        </div>
    </section>

    @php
        $carousels = [
            'propertyCarousel' => ['title' => 'Featured Properties', 'properties' => $properties],
            'propertyCarouselCasablanca' => ['title' => 'Casablanca Properties', 'properties' => $casablancaProperties],
            'propertyCarouselRabat' => ['title' => 'Rabat Properties', 'properties' => $rabatProperties],
            'propertyCarouselMarrakech' => ['title' => 'Marrakech Properties', 'properties' => $marrakechProperties],
        ];
    @endphp

    {{-- Property Carousels --}}
    @foreach($carousels as $carouselId => $carouselData)
        @if($carouselData['properties']->isNotEmpty())
        <section class="properties py-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="fw-bold">{{ $carouselData['title'] }}</h2>
                    <div>
                        <button class="btn btn-outline-secondary btn-sm me-1" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">&lt;</button>
                        <button class="btn btn-outline-secondary btn-sm" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">&gt;</button>
                    </div>
                </div>

                <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($carouselData['properties']->chunk(3) as $index => $propertyChunk)
                        <div class="carousel-item @if($index == 0) active @endif">
                            <div class="row g-3">
                                @foreach($propertyChunk as $property)
                                <div class="col-md-4 col-sm-6">
                                    <a href="{{ route('public.property.details', $property->id) }}" class="text-decoration-none text-dark d-block h-100">
                                        <div class="card property-card border-0 shadow-sm h-100">
                                            @php
                                                $image = $property->images->first();
                                            @endphp

                                            <div class="card-img-top">
                                                @if($image)
                                                    <img src="{{ asset('storage/'.$image->image_url) }}" alt="{{ $property->title }}">
                                                @else
                                                    <div class="empty-img"></div>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $property->title }}</h5>
                                                <p class="card-text text-muted mb-1">{{ $property->city }}, {{ $property->country }}</p>
                                                <p class="fw-bold">${{ $property->price_per_night }}/night</p>
                                                <div class="text-warning">
                                                    @for($i=0; $i<5; $i++)
                                                        {!! $i < round($property->rating ?? 4) ? '&#9733;' : '&#9734;' !!}
                                                    @endfor
                                                    <span class="text-muted small">({{ $property->reviews_count ?? 0 }} reviews)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
    @endforeach

</main>
@endsection
