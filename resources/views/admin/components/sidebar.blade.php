<!-- Sidebar -->
<div id="sidebar-wrapper" class="sidebar-wrapper d-flex flex-column">

    <!-- Heading -->
    <div class="sidebar-heading text-center py-4 border-bottom">
        <h4>Admin Panel</h4>
    </div>

    <!-- Menu Items -->
    <div class="list-group list-group-flush flex-grow-1">
        <a href="{{ route('dashboard') }}" class="list-group-item d-flex align-items-center">
            <i class="fas fa-tachometer-alt me-3"></i> Dashboard
        </a>
        <a href="{{ route('users.index') }}" class="list-group-item d-flex align-items-center">
            <i class="fas fa-users me-3"></i> Users
        </a>
        <a href="{{ route('properties.index') }}" class="list-group-item d-flex align-items-center">
            <i class="fas fa-building me-3"></i> Properties
        </a>
        <a href="{{ route('bookings.index') }}" class="list-group-item d-flex align-items-center">
            <i class="fas fa-calendar-check me-3"></i> Bookings
        </a>
        <a href="{{ route('payments.index') }}" class="list-group-item d-flex align-items-center">
            <i class="fas fa-credit-card me-3"></i> Payments
        </a>
        <a href="{{ route('reports.index') }}" class="list-group-item d-flex align-items-center">
            <i class="fas fa-chart-line me-3"></i> Reports
        </a>
        <a href="{{ route('settings.index') }}" class="list-group-item d-flex align-items-center">
            <i class="fas fa-cogs me-3"></i> Settings
        </a>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- Sidebar Toggle Button (for mobile) -->
<button class="btn btn-primary d-lg-none" id="sidebarToggle" style="position:fixed; top:22px; left:10px; z-index:1050;">
    <i class="fas fa-bars"></i>
</button>
