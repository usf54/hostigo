<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Request Received - Hostigo</title>
</head>
<body style="margin:0; padding:0; font-family: 'Nunito', sans-serif; background-color:#f7f7f7;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f7f7f7; padding:30px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 4px 14px rgba(0,0,0,0.08);">

          <!-- Header -->
          <tr>
            <td style="background:#E8524A; text-align:center; padding:30px;">
              <h1 style="margin:0; color:#fff;">Booking Request Received 🕒</h1>
              <p style="color:#ffe4eb; margin:10px 0 0; font-size:16px;">
                Thank you for booking with Hostigo
              </p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:40px; color:#333;">
              <h2>Hello {{ $booking->guest->name }},</h2>
              <p>Your booking request has been submitted successfully. 🎉</p>
              <p>
                Please note: your host needs to review and approve your request before it is officially confirmed.  
                We’ll notify you by email as soon as the host responds.
              </p>

              <p style="margin-top:20px;">
                <strong>Property:</strong> {{ $booking->property->title }} <br>
                <strong>Check-in:</strong> {{ $booking->check_in }} <br>
                <strong>Check-out:</strong> {{ $booking->check_out }} <br>
                <strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}
              </p>

              <p style="margin:20px 0;">
                Your Host: <strong>{{ $booking->property->host->name }}</strong>
              </p>

              <div style="text-align:center; margin:30px 0;">
                <a href="{{ route('guest.bookings.show', $booking->id) }}" 
                   style="background:#E8524A; color:#fff; padding:12px 24px; text-decoration:none; border-radius:30px; font-weight:bold;">
                   View Booking Request
                </a>
              </div>

              <p style="font-size:14px; color:#666;">
                Once your host approves, you’ll receive a confirmation email.  
                Cancellation policy applies and can be reviewed on your booking page.
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
