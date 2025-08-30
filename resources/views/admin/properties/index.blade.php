@extends('admin.layouts.admin')

@section('content')
<div class="p-4">

    <!-- Page Heading -->
    <h2 class="mb-4" style="font-size:1.8rem; font-weight:700; color:#1E1E2F;">Properties</h2>

    <!-- Properties Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table align-middle mb-0" style="width:100%; border-collapse: separate; border-spacing:0;">
            <thead style="background:#FF385C; color:#fff;">
                <tr>
                    <th class="py-2 px-3 text-center">ID</th>
                    <th class="py-2 px-3">Title</th>
                    <th class="py-2 px-3">Location</th>
                    <th class="py-2 px-3">Price</th>
                    <th class="py-2 px-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">{{ $property->id }}</td>
                    <td class="py-2 px-3">{{ $property->title }}</td>
                    <td class="py-2 px-3">{{ $property->city }}, {{ $property->country }}</td>
                    <td class="py-2 px-3">${{ number_format($property->price_per_night, 2) }}</td>
                    <td class="py-2 px-3 text-center">
                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-sm btn-info me-1" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-sm btn-success me-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
