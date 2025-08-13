@extends('layouts.app')

@section('content')
  <!-- Header Section -->
  <header class="about-header">
    <div class="container">
      <h1>About Hostigo</h1>
      <p class="mt-3">Connecting travelers with unique properties around the world</p>
    </div>
  </header>

  <!-- Mission & Story -->
  <section class="about-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h2>Our Story</h2>
          <p>Hostigo was founded with a simple mission: to make finding and booking the perfect stay easy, fast, and enjoyable. We connect travelers with unique properties across the globe — from cozy apartments to luxury villas. Every listing is verified to ensure safety, comfort, and an unforgettable experience.</p>
        </div>
        <div class="col-lg-6">
          <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511" alt="Our Story" class="img-fluid rounded-3">
        </div>
      </div>
    </div>
  </section>

  <!-- Mission -->
  <section class="about-section">
    <div class="container">
      <div class="row align-items-center flex-lg-row-reverse">
        <div class="col-lg-6">
          <h2>Our Mission</h2>
          <p>Our mission is to create a seamless booking experience, empowering travelers to explore the world while helping property owners reach a global audience. We are committed to innovation, transparency, and delivering value to both guests and hosts.</p>
        </div>
        <div class="col-lg-6">
          <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2" alt="Our Mission" class="img-fluid rounded-3">
        </div>
      </div>
    </div>
  </section>

  <!-- Meet the Team -->
  <section class="team-section text-center">
    <div class="container">
      <h2 class="mb-5">Meet Our Team</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="team-card">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Doe">
            <h5>John Doe</h5>
            <p class="text-muted">CEO & Founder</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="team-card">
            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Jane Smith">
            <h5>Jane Smith</h5>
            <p class="text-muted">Head of Operations</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="team-card">
            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Mike Brown">
            <h5>Mike Brown</h5>
            <p class="text-muted">Lead Developer</p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection