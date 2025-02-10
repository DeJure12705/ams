<x-guest-layout>
    <!-- Left Column: Takes up 2/3 of the width on medium screens and larger -->
    <div class="md:basis-2/3 lg:basis-7/12 flex flex-col items-center justify-center space-y-4">
        <!-- Images stacked on top of each other -->
        <div class="flex gap-3">
            <img src="{{ asset('images/logos/IC.svg') }}" alt="Logo 1" class="w-32 md:w-40 lg:w-44 drop-shadow-lg">
            <img src="{{ asset('images/logos/ICSA.svg') }}" alt="Logo 2" class="w-32 md:w-40 lg:w-44 drop-shadow-lg">
        </div>
        
        <!-- Text below the images -->
        <h1 class="text-3xl md:text-5xl lg:text-8xl font-extrabold text-center drop-shadow-2xl">
            <span class="text-yellow-400">Attendance</span> 
            <span class="text-white">Management</span> 
            <span class="text-yellow-400">System</span>
        </h1>
        <span class="text-gray-300 italic">© 2025 DNSC Codex. All Rights Reserved</span>
    </div>
    
    <!-- Right Column: Takes up 1/3 of the width on medium screens and larger -->
    <div class="md:basis-1/3 lg:basis-5/12 border-4 border-purple-900 md:border md:border-purple-900 lg:border-t-4 lg:border-b-4 lg:border-l-4 lg:border-r-0 bg-white p-6 py-12 rounded-xl md:rounded-l-3xl md:rounded-r-none shadow-md">
        <h1 class="text-3xl font-semibold text-center pb-14 text-purple-800">Admin Code</h1>
        <form action="{{ route('admin.code.verify') }}" method="post" id="codeform">
            @csrf
            @if (session('error'))
                <div class="alert alert-danger" style="height: 8vh; text-align: center;" role="alert">
                    <p class="error">{{ session('error') }}</p>
                </div>
            @endif
            <div class="alert alert-danger" style="height: 8vh; display: none;" role="alert">
                <p class="error"></p>
            </div>
            <div class="textfield">
                <x-input-label for="code" :value="__('Admin Code')" />
                <x-text-input id="code" class="block mt-1 w-full" type="password" name="code" placeholder="Enter Admin Code" required autofocus />
            </div>
            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="ms-4">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
            <div class="flex justify-center mt-3">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Back to login') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>