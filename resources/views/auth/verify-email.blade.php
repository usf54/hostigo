<x-guest-layout>
    <div class="mb-6 text-gray-700" style="font-family: 'Nunito', sans-serif;">
        <h2 class="text-2xl font-bold mb-2" style="color: #E8524A;">Welcome to Hostigo! 👋</h2>
        <p class="text-base">
            Thanks for signing up! Before you start exploring properties and making bookings, please verify your email address by clicking the link we just sent to your email.
        </p>
        <p class="text-base mt-2">
            If you didn't receive the email, no worries — we can send you another one.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 rounded-md text-green-700 bg-green-100 border border-green-200">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button style="background-color:#E8524A; color:#ffffff; padding:12px 24px; border-radius:30px; font-weight:bold;">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E8524A]">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
