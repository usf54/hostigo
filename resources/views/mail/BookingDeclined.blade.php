<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Declined - Hostigo</title>
</head>
<body style="margin:0; padding:0; font-family: 'Nunito', sans-serif; background:#f7f7f7;">

  <div style="width:100%; padding:30px 0; background:#f7f7f7; display:flex; justify-content:center;">
    <div style="max-width:600px; width:100%; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 4px 14px rgba(0,0,0,0.08);">

      <!-- Header -->
      <div style="border: 1px solid #cbc3c338; text-align:center; padding:30px; color:#000000;">
        <h1 style="margin:0;">Booking Declined ❌</h1>
        <p style="color:#ffe4eb; margin:10px 0 0; font-size:16px;">
          Unfortunately, your booking request was not approved
        </p>
      </div>

      <!-- Body -->
      <div style="padding:40px; color:#333;">
        <h2>Hello {{ $booking->guest->name }},</h2>
        <p>We regret to inform you that your booking request has been declined by the host.</p>

        <p>
          <strong>Property:</strong> {{ $booking->property->title }} <br>
          <strong>Requested Check-in:</strong> {{ $booking->check_in }} <br>
          <strong>Requested Check-out:</strong> {{ $booking->check_out }} <br>
        </p>

        <p style="margin:20px 0; font-size:14px; color:#555;">
          Don’t worry — you can explore other amazing properties on Hostigo that suit your needs.
        </p>

        <div style="text-align:center; margin:30px 0;">
          <a href="{{ route('public.properties') }}" 
             style="background:#E8524A; color:#fff; padding:12px 24px; text-decoration:none; border-radius:30px; font-weight:bold;">
             Find Another Property
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
