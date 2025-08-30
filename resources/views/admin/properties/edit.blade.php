@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm w-100" style="max-width:700px;">
        <div class="card-body">
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Edit Property</h2>

            <form class="row g-3" method="POST" action="{{ route('properties.update', $property->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $property->title) }}" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">City</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $property->city) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Country</label>
                        <input type="text" name="country" class="form-control" value="{{ old('country', $property->country) }}">
                    </div>
                </div>


                <!-- Price -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Price per Night ($)</label>
                    <input type="number" name="price_per_night" class="form-control" value="{{ old('price_per_night', $property->price_per_night) }}" required>
                </div>

                <!-- Existing Images -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Images</label>
                    <div class="d-flex flex-wrap gap-2 mb-2">
                        @foreach($property->images as $image)
                            <div class="position-relative" style="width:100px; height:80px;">
                                <img src="{{ asset('storage/' . ($image->image_url ?? $image->path)) }}" alt="Property Image" class="img-fluid rounded">
                                <input type="checkbox" name="remove_images[]" value="{{ $image->id }}" class="position-absolute top-0 end-0 m-1">
                            </div>
                        @endforeach
                    </div>
                    <input type="file" name="images[]" multiple class="form-control">
                    <small class="text-muted">Check images to remove or upload new ones.</small>
                </div>

                <!-- Amenities -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Amenities</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($amenities as $amenity)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                       name="amenities[]" 
                                       value="{{ $amenity->id }}" 
                                       id="amenity-{{ $amenity->id }}"
                                       {{ $property->amenities->contains($amenity->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="amenity-{{ $amenity->id }}">{{ $amenity->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Save Button -->
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
