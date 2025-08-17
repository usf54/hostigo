@extends('admin.layouts.admin')

@section('content')
<div class="p-4 max-w-lg mx-auto">

    <!-- Page Heading -->
    <h2 class="mb-4" style="font-size:1.8rem; font-weight:700; color:#1E1E2F;">Admin Settings</h2>

    <!-- Settings Form -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form class="space-y-4">

                <!-- Site Name -->
                <div>
                    <label class="form-label fw-semibold">Site Name</label>
                    <input type="text" class="form-control" value="Property Booking Platform">
                </div>

                <!-- Site Email -->
                <div>
                    <label class="form-label fw-semibold">Site Email</label>
                    <input type="email" class="form-control" value="admin@example.com">
                </div>

                <!-- Timezone -->
                <div>
                    <label class="form-label fw-semibold">Timezone</label>
                    <select class="form-select">
                        <option>UTC</option>
                        <option>GMT</option>
                        <option>EST</option>
                        <option>PST</option>
                        <option>CET</option>
                    </select>
                </div>

                <!-- Site Logo -->
                <div>
                    <label class="form-label fw-semibold">Site Logo</label>
                    <input type="file" class="form-control">
                </div>

                <!-- Save Button -->
                <div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Save Settings
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
