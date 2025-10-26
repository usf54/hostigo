@extends('layouts.app')

@section('content')
<style>
  /* --- Custom Styles --- */
  .about-hero {
    position: relative;
    background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e') center/cover no-repeat;
    color: #fff;
    padding: 120px 0;
    text-align: center;
  }
  .about-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
  }
  .about-hero .container {
    position: relative;
    z-index: 2;
  }

  .about-section {
    padding: 80px 0;
  }
  .about-section h2 {
    font-weight: 700;
    margin-bottom: 20px;
  }
  .about-section p {
    color: #555;
    font-size: 1.05rem;
  }

  .team-section {
    background: #f9fafc;
    padding: 90px 0;
  }
  .team-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
    padding: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .team-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
  }
  .team-card img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 20px;
    border: 4px solid #eee;
  }
  .team-card h5 {
    font-weight: 600;
  }
  .team-card p {
    color: #777;
    margin: 0;
  }
</style>

<!-- Hero Header -->
<header class="about-hero">
  <div class="container">
    <h1 class="display-4 fw-bold">About Hostigo</h1>
    <p class="lead mt-3">Connecting travelers with unique stays around the world</p>
  </div>
</header>

<!-- Our Story -->
<section class="about-section">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <h2>Our Story</h2>
        <p>
          Hostigo was founded with a simple mission: to make finding and booking the perfect stay easy, fast, and enjoyable.
          We connect travelers with unique properties across the globe — from cozy apartments to luxury villas. 
          Every listing is verified to ensure safety, comfort, and an unforgettable experience.
        </p>
      </div>
      <div class="col-lg-6 text-center">
        <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511"
             alt="Our Story" class="img-fluid rounded-4 shadow">
      </div>
    </div>
  </div>
</section>

<!-- Our Mission -->
<section class="about-section bg-light">
  <div class="container">
    <div class="row align-items-center gy-5 flex-lg-row-reverse">
      <div class="col-lg-6">
        <h2>Our Mission</h2>
        <p>
          Our mission is to create a seamless booking experience, empowering travelers to explore the world
          while helping property owners reach a global audience. We are committed to innovation, transparency,
          and delivering value to both guests and hosts.
        </p>
      </div>
      <div class="col-lg-6 text-center">
        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2"
             alt="Our Mission" class="img-fluid rounded-4 shadow">
      </div>
    </div>
  </div>
</section>
@endsection
