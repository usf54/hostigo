@extends('layouts.app')

@section('content')
<style>
  /* --- Hero Section --- */
  .contact-hero {
    position: relative;
    background: url('https://images.unsplash.com/photo-1505691723518-36a5ac3be353') center/cover no-repeat;
    color: #fff;
    text-align: center;
    padding: 120px 0;
  }
  .contact-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
  }
  .contact-hero .container {
    position: relative;
    z-index: 2;
  }

  /* --- Contact Section --- */
  .contact-section {
    padding: 90px 0;
    background-color: #f9fafc;
  }

  .contact-section h2 {
    font-weight: 700;
  }

  /* --- Contact Form --- */
  form {
    background: #fff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
  }
  form .form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    box-shadow: none;
  }
  form .form-control:focus {
    border-color: #FF385C;
    box-shadow: 0 0 0 0.15rem rgba(255, 56, 92, 0.25);
  }
  form button {
    background-color: #FF385C;
    border: none;
    border-radius: 10px;
    transition: 0.3s;
  }
  form button:hover {
    background-color: #e63254;
  }

  /* --- Contact Info --- */
  .contact-info {
    background: #fff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
  }
  .contact-info h5 {
    font-weight: 600;
    margin-top: 20px;
    color: #FF385C;
  }
  .contact-info p {
    margin-bottom: 15px;
    color: #555;
  }
  .contact-info a {
    color: #FF385C;
    font-weight: 500;
    transition: color 0.2s ease;
  }
  .contact-info a:hover {
    color: #e63254;
    text-decoration: underline;
  }
</style>

<!-- Hero Section -->
<section class="contact-hero">
  <div class="container">
    <h1 class="display-5 fw-bold">Contact Hostigo</h1>
    <p class="lead mt-3">We’re here to help! Reach out with any questions or feedback.</p>
  </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
  <div class="container">
    <div class="row g-5 align-items-start">

      <!-- Contact Form -->
      <div class="col-lg-7">
        <h2 class="mb-4">Send Us a Message</h2>
        <form>
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Your Name</label>
            <input type="text" class="form-control" id="name" placeholder="John Doe" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Your Email</label>
            <input type="email" class="form-control" id="email" placeholder="example@mail.com" required>
          </div>
          <div class="mb-3">
            <label for="subject" class="form-label fw-semibold">Subject</label>
            <input type="text" class="form-control" id="subject" placeholder="Booking Inquiry">
          </div>
          <div class="mb-3">
            <label for="message" class="form-label fw-semibold">Message</label>
            <textarea class="form-control" id="message" rows="5" placeholder="Write your message here..." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary px-4 py-2">Send Message</button>
        </form>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-5">
        <h2 class="mb-4">Contact Information</h2>
        <div class="contact-info">
          <h5><i class="bi bi-envelope-fill me-2"></i>Email</h5>
          <p>support@hostigo.com</p>

          <h5><i class="bi bi-telephone-fill me-2"></i>Phone</h5>
          <p>+1 234 567 890</p>

          <h5><i class="bi bi-geo-alt-fill me-2"></i>Office Address</h5>
          <p>123 Main Street, Casablanca, Morocco</p>

          <h5><i class="bi bi-share me-2"></i>Follow Us</h5>
          <p>
            <a href="#"><i class="bi bi-instagram"></i> Instagram</a> |
            <a href="#"><i class="bi bi-facebook"></i> Facebook</a> |
            <a href="#"><i class="bi bi-twitter-x"></i> Twitter</a>
          </p>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection
