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

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Property Title & Host -->
    <div class="mb-4">
        <h1 class="fw-bold">{{ $property->title }}</h1>
        <p class="text-muted">
            Hosted by
            @if($property->host)
                <a href="{{ route('host.profile.show', $property->host->id) }}" class="text-decoration-none">
                    <strong>{{ $property->host->name }}</strong>
                </a>
            @else
                <strong>Unknown</strong>
            @endif
        </p>
    </div>

    <!-- Image Gallery -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <img src="{{ asset('storage/'.$property->images->first()->image_url ?? 'placeholder.jpg') }}" class="img-fluid rounded" alt="{{ $property->title }}">
        </div>
        <div class="col-md-6">
            <div class="row g-3">
                @foreach($property->images->skip(1)->take(4) as $image)
                    <div class="col-6">
                        <img src="{{ asset('storage/'.$image->image_url) }}" class="img-fluid rounded" alt="{{ $property->title }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Property Info -->
    <div class="row">
        <div class="col-lg-8">
            <div class="mb-4">
                <h4>About this property</h4>
                <p>{{ $property->description }}</p>
            </div>

            <div class="mb-4">
                <h4>Features</h4>
                <ul class="list-unstyled">
                    @foreach($property->amenities as $amenity)
                        <li>✔ {{ $amenity->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4>Location</h4>
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}&hl=es;z=14&output=embed"
                        width="600" height="450" style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        title="Map showing the location of {{ $property->title }}">></iframe>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm p-3">
                <form action="{{ route('bookings.store', $property) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="check_in">Check-in</label>
                        <input id="check_in" type="text" name="check_in" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="check_out">Check-out</label>
                        <input id="check_out" type="text" name="check_out" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="guests">Guests</label>
                        <input id="guests" type="number" name="guests" class="form-control" min="1" value="1" required>
                    </div>
                    <button type="submit" class="btn w-100" style="background-color: #FF385C; color: white;">
                        Reserve
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    const bookedRanges = @json($bookedDates->map(fn($b) => [
        'from' => $b->check_in,
        'to' => $b->check_out,
    ]));
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        flatpickr("input[name='check_in']", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: bookedRanges,
            onChange: function(selectedDates, dateStr, instance) {
                if (dateStr) {
                    checkOutCalendar.set("minDate", dateStr); // set check-out min date
                }
            }
        });

        const checkOutCalendar = flatpickr("input[name='check_out']", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: bookedRanges
        });
    });
</script>

@endsection
