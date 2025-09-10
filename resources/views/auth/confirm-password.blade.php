<x-guest-layout>
    <div class="mb-6 text-gray-700" style="font-family: 'Nunito', sans-serif;">
        <h2 class="text-2xl font-bold mb-2" style="color: #E8524A;">Confirm Your Password 🔐</h2>
        <p class="text-base">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="mt-6">
        @csrf

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full border-gray-300 focus:border-[#E8524A] focus:ring focus:ring-[#E8524A]/50 rounded-md shadow-sm" 
                type="password" 
                name="password" 
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button style="background-color:#E8524A; color:#ffffff; padding:12px 24px; border-radius:30px; font-weight:bold;">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
