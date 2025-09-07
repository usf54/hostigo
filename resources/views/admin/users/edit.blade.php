@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">
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
    <!-- Edit User Card -->
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Edit User</h2>

            <!-- Edit Form -->
            <form class="row g-3" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Image -->
                <div class="col-12 text-center mb-3">
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="rounded-circle mb-2" style="width:100px; height:100px; object-fit:cover;">
                    @endif
                    <input type="file" name="image" class="form-control form-control-sm mt-2">
                </div>

                <!-- Name -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- Email -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <!-- Phone -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>

                <!-- Role -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="guest" {{ $user->role == 'guest' ? 'selected' : '' }}>Guest</option>
                        <option value="host" {{ $user->role == 'host' ? 'selected' : '' }}>Host</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <!-- Save Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
