<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel Recipe App') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
    <body class="bg-gray-50 text-gray-900" x-data="{ mobileOpen: false, loginOpen: false }">

    <!-- Transparent Hero Nav -->
    <header class="absolute top-0 w-full z-50 transition-transform duration-500 ease-ease">
        <div class="w-full mx-auto px-6 flex justify-between items-center py-4 {{ Str::slug(Route::currentRouteName(), '-') }}">
            <!-- Logo -->
            <x-nav-logo variant="dark" />
            <!-- Links -->
            <x-nav-links variant="dark" layout="horizontal" />
            <!-- Auth -->
            <x-nav-auth variant="dark" />

            <!-- Hamburger -->
            <button @click="mobileOpen = true" class="md:hidden text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </header>

    <!-- Sticky Green Nav -->
    <header 
        x-data="{ scrolled: false }" 
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 80 })"
        class="fixed top-0 left-0 w-full z-40 transition-transform duration-500 ease-ease">

        <div 
            :class="scrolled ? 'translate-y-0 bg-green-700 shadow-md' : '-translate-y-full'"
            class="green transition-transform duration-500 w-full">
            
            <div class="w-full mx-auto px-6 flex justify-between items-center py-4">
                <x-nav-logo variant="white" />
                <x-nav-links variant="white" layout="horizontal" />
                <x-nav-auth variant="white" layout="horizontal" />

                <!-- Hamburger -->
                <button @click="mobileOpen = true" class="md:hidden text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Sidebar (Shared for both navs) -->
    <div x-show="mobileOpen" class="fixed inset-0 z-50 flex">
      <!-- Backdrop -->
      <div @click="mobileOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 transition-opacity">
      </div>

      <!-- Sidebar -->
      <div x-show="mobileOpen"
        x-transition:enter="transform transition ease-in-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="relative bg-green-700 text-white w-64 p-6 space-y-6">

        <!-- Close Button -->
        <button @click="mobileOpen = false" class="absolute top-4 right-4 text-white">✕</button>

        <!-- Logo -->
        <x-nav-logo variant="white" />

        <!-- Links (vertical layout) -->
        <x-nav-links variant="white" layout="vertical" />

        <!-- Auth -->
        <x-nav-auth variant="white" layout="vertical" />
      </div>

    </div>
    <!-- Page Content -->
    <main class="{{ Str::slug(Route::currentRouteName(), '-') }}">
        @yield('content')
    </main>
    <footer>
        @include('layouts.footer')
    </footer>
         <!-- Login Modal -->
    <div 
        x-show="loginOpen"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        @click.self="loginOpen = false"
    >
        <div id="loginModalContent" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <!-- Close Button -->
            <button 
                @click="loginOpen = false" 
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
            >
                ✕
            </button>

            <h2 class="text-2xl font-bold mb-4">Login</h2>

            <div id="loginError" class="hidden mb-4 p-2 bg-red-100 text-red-700 rounded"></div>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required autofocus 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500">
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                    Log in
                </button>
            </form>
        </div>
    </div>
</body>
</html>
