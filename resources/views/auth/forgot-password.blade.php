<x-guest-layout>
    <div class="mb-6 text-gray-700" style="font-family: 'Nunito', sans-serif;">
        <h2 class="text-2xl font-bold mb-2" style="color: #E8524A;">Forgot Your Password? 🔑</h2>
        <p class="text-base">
            No worries! Just enter your email address below and we will send you a link to reset your password.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 p-4 rounded-md text-green-700 bg-green-100 border border-green-200" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="mt-6">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full border-gray-300 focus:border-[#E8524A] focus:ring focus:ring-[#E8524A]/50 rounded-md shadow-sm"                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button style="background-color:#E8524A; color:#ffffff; padding:12px 24px; border-radius:30px; font-weight:bold;">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
