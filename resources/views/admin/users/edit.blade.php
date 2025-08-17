@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">

    <!-- Edit User Card -->
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Edit User</h2>

            <!-- Edit Form -->
            <form class="row g-3">

                <!-- Name -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text" class="form-control" value="John Doe">
                </div>

                <!-- Email -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" value="john@example.com">
                </div>

                <!-- Role -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Role</label>
                    <select class="form-select">
                        <option>User</option>
                        <option>Admin</option>
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
