<x-guest-layout>
    <img src="{{ asset('assets/images/favicon.png') }}" width="100" height="100">
    <div class="w-full max-w-4xl rounded-xl shadow-sm border border-black-100 p-8">
    
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Profile Image (alone on the first line) -->
            <div class="mb-6 flex flex-col items-center">
                <x-input-label for="image" :value="__('Profile Image')" />

                <!-- Preview -->
                <img id="preview" 
                    src="{{ asset('storage/profile/default.jfif') }}" 
                    class="w-24 h-24 rounded-full object-cover border-2 border-pink-500 mt-2 cursor-pointer">

                <!-- Hidden input -->
                <input id="image" 
                    type="file" 
                    name="image" 
                    class="hidden" 
                    accept="image/*">

                <!-- Button -->
                <button type="button" 
                        onclick="document.getElementById('image').click()" 
                        class="mt-3 px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-md">
                    Choose Image
                </button>

                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <!-- Grid for other inputs -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <x-text-input 
                        id="name" 
                        class="block mt-1 w-full border border-pink-500 rounded-md px-4 py-2" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        placeholder="John Doe"
                        required 
                        autofocus 
                        autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full border border-pink-500 rounded-md px-4 py-2" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        placeholder="example@gmail.com"
                        required 
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div>
                    <x-text-input 
                        id="phone" 
                        class="block mt-1 w-full border border-pink-500 rounded-md px-4 py-2" 
                        type="text" 
                        name="phone" 
                        :value="old('phone')" 
                        placeholder="+212 600 000 000"
                        required 
                        autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Role -->
                <div>
                    <select id="role" name="role" class="block mt-1 w-full border border-pink-500 rounded-md px-4 py-2" required>
                        <option value="" disabled selected>e.g., Guest</option>
                        <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                        <option value="host" {{ old('role') == 'host' ? 'selected' : '' }}>Host</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full border border-pink-500 rounded-md px-4 py-2" 
                        type="password" 
                        name="password" 
                        placeholder="At least 8 characters"
                        required 
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-text-input 
                        id="password_confirmation" 
                        class="block mt-1 w-full border border-pink-500 rounded-md px-4 py-2" 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Repeat your password"
                        required 
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-between mt-8">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-primary-button class="ms-4" style="background-color: #FF385C;">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
