<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 hidden" :status="session('status')" />

    <!-- Left Column: Takes up 2/3 of the width on medium screens and larger -->
    <div class="md:basis-2/3 lg:basis-7/12 flex flex-col items-center justify-center space-y-4">
        <!-- Images stacked on top of each other -->

        <div class="flex gap-3 mx-auto">
            <img src="{{ asset('images/logos/IC.svg') }}" alt="Logo 1" class="w-32 md:w-40 lg:w-44 drop-shadow-lg">
            <img src="{{ asset('images/logos/ICSA.svg') }}" alt="Logo 2" class="w-32 md:w-40 lg:w-44 drop-shadow-lg">
        </div>


        <h1 class="text-3xl md:text-5xl lg:text-8xl font-extrabold text-center drop-shadow-2xl">
            <span class="text-yellow-400">Attendance</span>
            <span class="text-white">Management</span>
            <span class="text-yellow-400">System</span>
        </h1>
        <span class="text-gray-300 italic">© 2025 DNSC Codex. All Rights Reserved</span>
    </div>
    <!-- Right Column: Takes up 1/3 of the width on medium screens and larger -->
    <div
        class="md:basis-1/3 lg:basis-5/12 border-4 border-purple-900 md:border md:border-purple-900 lg:border-t-4 lg:border-b-4 lg:border-l-4 lg:border-r-0 bg-white p-6 py-12 rounded-xl md:rounded-l-3xl md:rounded-r-none shadow-md">
        <h1 class="text-3xl font-semibold text-center pb-14 text-purple-800">Welcome Admin!</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="admin_email" :value="__('Email Address')" />
                <x-text-input id="admin_email" placeholder="test@example.com" class="block mt-1 w-full" type="email" name="admin_email"
                    :value="old('admin_email')" required autofocus />
                <x-input-error :messages="$errors->get('admin_email')" class="mt-2 text-red-600" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" placeholder="Enter your password" class="block mt-1 w-full" type="password" name="password" required />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
            </div>


            <div class="flex items-center justify-between mt-4">
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex justify-center mt-5">
                <x-primary-button class="ms-3 w-full">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        <div class="flex justify-center mt-5">
            Don't have an account? <a href="{{ route('admin.code') }}" class="text-blue-700 ml-1"> Create
                Account</a>

        </div>

    </div>
</x-guest-layout>
