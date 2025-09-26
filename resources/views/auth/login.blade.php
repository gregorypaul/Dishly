<x-guest-layout>
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <svg class="w-10 h-10 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 123.65 268.08">
                    <g>
                        <polygon points="94.42 90.69 85.61 87.47 11.91 257.88 39.82 268.08 94.42 90.69" style="fill:#dc2626"/>
                        <ellipse cx="100.26" cy="59.46" rx="41.53" ry="19.74"
                                 transform="translate(9.99 133.22) rotate(-69.92)" style="fill:#dc2626"/>
                    </g>
                    <g>
                        <polygon points="48.6 86.65 39.76 89.78 91.53 268.08 119.54 258.17 48.6 86.65" style="fill:#dc2626"/>
                        <ellipse cx="33.21" cy="58.86" rx="19.74" ry="41.53"
                                 transform="translate(-17.74 14.46) rotate(-19.5)" style="fill:#dc2626"/>
                    </g>
                </svg>
                <span class="text-2xl font-bold text-red-600">Dishly</span>
            </a>
        </div>

        <!-- Heading -->
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Login to Your Account</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                              :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-green-600 hover:text-green-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <div>
                <x-primary-button class="w-full justify-center bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Register Link -->
        <p class="mt-6 text-center text-sm text-gray-600">
            Don’t have an account? 
            <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800 font-semibold">Sign up</a>
        </p>
    </div>
</x-guest-layout>