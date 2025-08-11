<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>@yield('title', 'Hostigo | Property Booking')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                {{-- House SVG in #FF385C --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#FF385C" viewBox="0 0 24 24" class="me-2">
                    <path d="M12 3l8 7v11a1 1 0 0 1-1 1h-5v-6H10v6H5a1 1 0 0 1-1-1V10l8-7z"/>
                </svg>
                Hostigo
            </a>


            <!-- Hamburger Menu -->
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/explore') }}">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                    </li>
                </ul>

                <!-- Auth Buttons -->
                @if (Route::has('login'))
                    <div class="d-flex gap-2 mt-2 mt-lg-0">
                        @auth
                            <div class="dropdown ms-3">
                                <button class="btn btn-light dropdown-toggle d-inline-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>{{ Auth::user()->name }}</span>
                                    
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                                            {{ __('Profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            {{ __('Settings') }}
                                        </a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        @else
                            <a href="{{ route('login') }}" class="btn btn-login btn-sm">Log In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-signup btn-sm">Sign Up</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <footer class="footer pt-5 pb-4">
        <div class="container">

            <div class="row gy-4">

                <!-- Brand & Description -->
                <div class="col-md-4">
                    <h4 class="fw-bold mb-3" style="color: #FF385C;">Hostigo</h4>
                    <p class="small">
                        Hostigo helps you find unique stays and unforgettable experiences worldwide.
                        Whether it’s a cozy cabin, a luxury villa, or a city apartment, we’ve got you covered.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-2">
                    <h6 class="fw-bold text-uppercase">Quick Links</h6>
                    <ul class="list-unstyled mt-3">
                        <li><a href="{{ url('/') }}" class=" text-decoration-none small">Home</a></li>
                        <li><a href="{{ url('/explore') }}" class=" text-decoration-none small">Explore</a></li>
                        <li><a href="{{ url('/about') }}" class=" text-decoration-none small">About Us</a></li>
                        <li><a href="{{ url('/contact') }}" class=" text-decoration-none small">Contact</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="col-md-2">
                    <h6 class="fw-bold text-uppercase">Support</h6>
                    <ul class="list-unstyled mt-3">
                        <li><a href="#" class="text-decoration-none small">Help Center</a></li>
                        <li><a href="#" class="text-decoration-none small">Cancellation Options</a></li>
                        <li><a href="#" class="text-decoration-none small">Safety Information</a></li>
                        <li><a href="#" class="text-decoration-none small">FAQs</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-md-4">
                    <h6 class="fw-bold text-uppercase">Subscribe to Our Newsletter</h6>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" aria-label="Email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                    <div class="mt-3">
                        <a href="#" class=" me-3"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class=" me-3"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class=""><i class="bi bi-twitter fs-5"></i></a>
                    </div>
                </div>

            </div>

            <hr class="my-4" style="color: #FF385C;">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="small mb-0">&copy; {{ date('Y') }} Hostigo. All rights reserved.</p>
                <div>
                    <a href="#" class="small text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="small text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
