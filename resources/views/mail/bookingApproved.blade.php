<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Approved - Hostigo</title>
</head>
<body style="margin:0; padding:0; font-family:'Nunito', sans-serif; background:#f7f7f7;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f7f7f7; padding:30px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 4px 14px rgba(0,0,0,0.08);">

          <!-- Header -->
          <tr>
            <td style="background:#16a34a; text-align:center; padding:30px;">
              <h1 style="margin:0; color:#fff;">Booking Approved ✅</h1>
              <p style="color:#d1fae5; margin:10px 0 0; font-size:16px;">
                Your stay is officially confirmed
              </p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:40px; color:#333;">
              <h2>Hello {{ $booking->guest->name }},</h2>
              <p>Great news! 🎉 Your host has approved your booking request. Your stay is now officially confirmed.</p>

              <p style="margin-top:20px;">
                <strong>Property:</strong> {{ $booking->property->title }} <br>
                <strong>Check-in:</strong> {{ $booking->check_in }} <br>
                <strong>Check-out:</strong> {{ $booking->check_out }} <br>
                <strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}
              </p>

              <p style="margin:20px 0;">
                Host: <strong>{{ $booking->property->host->name }}</strong><br>
                Email: <strong>{{ $booking->property->host->email }}</strong><br>
                Phone: <strong>{{ $booking->property->host->phone }}</strong>
              </p>

              <div style="text-align:center; margin:30px 0;">
                <a href="{{ route('guest.bookings.show', $booking->id) }}" 
                   style="background:#16a34a; color:#fff; padding:12px 24px; text-decoration:none; border-radius:30px; font-weight:bold;">
                   View Booking Details
                </a>
              </div>

              <p style="font-size:14px; color:#666;">
                Please make sure to contact your host if you have special requests.  
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#f1f5f9; text-align:center; padding:20px; font-size:14px; color:#64748b;">
              <p style="margin:0;">© {{ date('Y') }} Hostigo. All rights reserved.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
