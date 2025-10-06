<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Action - Hostigo</title>
</head>
<body style="margin:0; padding:0; font-family: 'Nunito', sans-serif; background:#f7f7f7;">

  <div style="width:100%; padding:30px 0; background:#f7f7f7; display:flex; justify-content:center;">
    <div style="max-width:600px; width:100%; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 4px 14px rgba(0,0,0,0.08);">

      <!-- Header -->
      <div style="border: 1px solid #cbc3c338; text-align:center; padding:30px; color:#000000;">
        <h1 style="margin:0;">Booking {{ ucfirst($action) }}</h1>
      </div>

      <!-- Body -->
      <div style="padding:40px; color:#333;">
        <h2>Hello {{ $booking->property->host->name }},</h2>
        <p>You have <strong>{{ $action }}</strong> the following booking:</p>

        <p>
          <strong>Property:</strong> {{ $booking->property->title }} <br>
          <strong>Guest:</strong> {{ $booking->guest->name }} <br>
          <strong>Check-in:</strong> {{ $booking->check_in }} <br>
          <strong>Check-out:</strong> {{ $booking->check_out }} <br>
          <strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}
        </p>

        <div style="text-align:center; margin:30px 0;">
          <a href="{{ route('host.bookings.show', $booking->id) }}" 
             style="background:#E8524A; color:#fff; padding:12px 24px; text-decoration:none; border-radius:30px; font-weight:bold;">
             View Booking Details
          </a>
        </div>
      </div>

      <!-- Footer -->
      <div style="background:#f1f5f9; text-align:center; padding:20px; font-size:14px; color:#64748b;">
        <p style="margin:0;">© {{ date('Y') }} Hostigo. All rights reserved.</p>
      </div>

    </div>
  </div>

</body>
</html>
