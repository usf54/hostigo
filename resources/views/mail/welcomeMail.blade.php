<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Hostigo</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&family=Nunito:wght@400;600&display=swap" rel="stylesheet">
</head>
<body style="margin:0; padding:0; font-family: 'Nunito', sans-serif; background-color: #f7f7f7;">

    <div style="width:100%; padding:30px 0; display:flex; justify-content:center; background-color:#f7f7f7;">
        <div style="max-width:600px; width:100%; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 14px rgba(0,0,0,0.08);">

            {{-- Header --}}
            <div style="background: #E8524A; text-align: center; padding: 30px;">
                <h1 style="margin: 0; color: #ffffff; font-size: 32px; font-family: 'Raleway', sans-serif;">Hostigo</h1>
                <p style="color: #ffe4eb; margin: 10px 0 0; font-size: 18px; font-style: italic;">
                    Your next stay, just a click away
                </p>
            </div>

            {{-- Hero Image --}}
            <div style="text-align:center; padding: 20px 0;">
                <img src="{{ $message->embedData(file_get_contents(public_path('assets/images/logo.png')), 'logo.png', 'image/png') }}" width="150" height="150" alt="Hostigo Logo">
            </div>

            {{-- Body --}}
            <div style="padding: 40px; color: #333;">
                <h2 style="margin-top: 0; font-size: 24px; font-weight: 700; font-family: 'Raleway', sans-serif;">
                    Hello {{ $user->name ?? 'Traveler' }}! 👋
                </h2>
                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                    Welcome to <strong style="color:#E8524A;">Hostigo</strong>! We’re thrilled to have you join our travel community. 
                    Whether you're looking for your dream getaway or ready to host travelers from all over the world, 
                    we’ve got the perfect experience waiting for you.
                </p>

                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Start exploring properties, manage your bookings, and plan unforgettable stays with ease.
                </p>

                <div style="text-align: center;">
                    <a href="{{ url('/') }}" 
                       style="background: #E8524A; color: #ffffff; text-decoration: none; padding: 14px 30px; font-size: 16px; border-radius: 30px; font-weight: bold; font-family: 'Nunito', sans-serif;">
                       Explore Hostigo
                    </a>
                </div>
            </div>

            {{-- Footer --}}
            <div style="background: #f1f5f9; text-align: center; padding: 20px; font-size: 14px; color: #64748b;">
                <p style="margin: 0;">© {{ date('Y') }} Hostigo. All rights reserved.</p>
                <p style="margin: 5px 0 0;">Need help? <a href="{{ url('/contact') }}" style="color: #E8524A; text-decoration: none;">Contact Support</a></p>
            </div>

        </div>
    </div>

</body>
</html>
