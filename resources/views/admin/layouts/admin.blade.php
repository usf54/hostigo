<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <!-- FavIcon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body>

<div class="d-flex" id="admin-wrapper">

    <!-- Sidebar -->
    @include('admin.components.sidebar')

    <!-- Page Content -->
    <div id="page-content-wrapper" class="w-100">
        <!-- Top Navbar -->
        @include('admin.components.header')

        <!-- Main Content -->
        <div class="container-fluid p-4">
            @yield('content')
        </div>

    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar-wrapper");
    const content = document.getElementById("content-wrapper");
    const toggleBtn = document.getElementById("sidebarToggle");

    toggleBtn.addEventListener("click", function() {
        if (window.innerWidth < 992) {
            sidebar.classList.toggle("active"); // Mobile toggle overlay
        } else {
            sidebar.classList.toggle("collapsed"); // Desktop collapse
            content.classList.toggle("full");
        }
    });
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
