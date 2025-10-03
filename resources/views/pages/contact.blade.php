@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1 class="fw-bold">Contact Hostigo</h1>
            <p class="lead">We’re here to help! Reach out with any questions or feedback.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row g-5">
                
                <!-- Contact Form -->
                <div class="col-lg-7">
                    <h2 class="mb-4">Send Us a Message</h2>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" placeholder="John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" placeholder="example@mail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Booking Inquiry">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Write your message here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-4">Send Message</button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-5">
                    <h2 class="mb-4">Contact Information</h2>
                    <div class="contact-info">
                        <h5>Email</h5>
                        <p>support@hostigo.com</p>
                        
                        <h5>Phone</h5>
                        <p>+1 234 567 890</p>
                        
                        <h5>Office Address</h5>
                        <p>123 Main Street, Casablanca, Morocco</p>
                        
                        <h5>Follow Us</h5>
                        <p>
                            <a href="#" style="color: #FF385C; text-decoration: none;">Instagram</a> |
                            <a href="#" style="color: #FF385C; text-decoration: none;">Facebook</a> |
                            <a href="#" style="color: #FF385C; text-decoration: none;">Twitter</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
