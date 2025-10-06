<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center  px-4">
        <div class="bg-white w-full max-w-md rounded-xl shadow-sm border border-gray-100 p-8 text-center">

            {{-- Logo --}}
            <div class="flex justify-center mb-6">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Hostigo Logo" class="w-12 h-12">
            </div>

            {{-- Title --}}
            <h1 class="text-xl font-semibold text-gray-900 mb-3">Confirm your email address</h1>

            {{-- Message --}}
            <p class="text-gray-600 text-sm leading-relaxed mb-6">
                Please click the button below to verify your email address and finish setting up your account.
                This link is valid for 48 hours.
            </p>

            {{-- Success Alert --}}
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 p-3 rounded-lg text-green-700 bg-green-100 border border-green-200 text-sm">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-full px-6 py-2.5 transition-colors">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-500 hover:text-gray-700 underline transition-colors">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <div class="mt-8 border-t pt-4 text-xs text-gray-400">
                <p>&nbsp;•&nbsp; HostiGo &nbsp;•&nbsp;</p>
            </div>
        </div>
    </div>
</x-guest-layout>
