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
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 123.65 268.08">
                    <g>
                        <polygon points="94.42 90.69 85.61 87.47 11.91 257.88 39.82 268.08 94.42 90.69" style="fill:{{ request()->routeIs('recipes.show') ? '#ffffff;' :'#dc2626;' }}"/>
                        <ellipse cx="100.26" cy="59.46" rx="41.53" ry="19.74"
                                 transform="translate(9.99 133.22) rotate(-69.92)" style="fill:{{ request()->routeIs('recipes.show') ? '#ffffff;' :'#dc2626;' }}"/>
                    </g>
                    <g>
                        <polygon points="48.6 86.65 39.76 89.78 91.53 268.08 119.54 258.17 48.6 86.65" style="fill:{{ request()->routeIs('recipes.show') ? '#ffffff;' :'#dc2626;' }}"/>
                        <ellipse cx="33.21" cy="58.86" rx="19.74" ry="41.53"
                                 transform="translate(-17.74 14.46) rotate(-19.5)" style="fill:{{ request()->routeIs('recipes.show') ? '#ffffff;' :'#dc2626;' }}"/>
                    </g>
                </svg>
                <span class="{{ request()->routeIs('recipes.show') ? 'text-white text-2xl font-bold' :'text-2xl font-bold text-red-600' }}">Dishly</span>
            </a>

            <!-- Links -->
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class={{ request()->routeIs('recipes.show') ? 'text-white hover:text-red-600' : 'text-gray-700 hover:text-red-600' }}>Home</a>
                <a href="{{ route('recipes.index') }}" class={{ request()->routeIs('recipes.show') ? 'text-white hover:text-red-600' : 'text-gray-700 hover:text-red-600' }}>Recipes</a>
                <a href="#" class="{{ request()->routeIs('recipes.show') ? 'text-white hover:text-red-600' : 'text-gray-700 hover:text-red-600' }}">About</a>
                <a href="#" class="{{ request()->routeIs('recipes.show') ? 'text-white hover:text-red-600' : 'text-gray-700 hover:text-red-600' }}">Contact</a>
            </nav>

            <!-- Auth -->
            <div class="hidden md:flex space-x-4 items-center">
                @auth
                    @include('layouts.partials.avatar')
                     @php
                        $email = auth()->user()->email;
                        $name = Str::before($email, '@');

                        @endphp
                    <span class="{{ request()->routeIs('recipes.show') ? 'text-white hover:text-red-600' : 'text-gray-700 hover:text-red-600' }}">Hi, {{ $name }}</span>
                    <!-- Avatar -->
                    <form action="{{ route('logout') }}" method="POST" class="inline ">
                        @csrf
                        <button type="submit" class="text-gray-600 font-medium {{ request()->routeIs('recipes.show') ? 'text-white hover:text-red-600' : 'text-gray-700 hover:text-red-600' }}">Logout</button>
                    </form>
                @else
                    <button 
                        @click="loginOpen = true" 
                        class="text-gray-600 font-medium {{ request()->routeIs('recipes.show') ? 'text-white hover:text-red-600' : 'text-gray-700 hover:text-red-600' }}">
                        Login
                    </button>    
                    <a href="{{ route('register') }}" class="bg-green-600 text-white px-2 py-1 rounded-md">Sign Up</a>
                @endauth
            </div>

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
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 123.65 268.08">
                        <g>
                            <polygon points="94.42 90.69 85.61 87.47 11.91 257.88 39.82 268.08 94.42 90.69" style="fill:#ffffff;"/>
                            <ellipse cx="100.26" cy="59.46" rx="41.53" ry="19.74"
                                     transform="translate(9.99 133.22) rotate(-69.92)" style="fill:#ffffff;"/>
                        </g>
                        <g>
                            <polygon points="48.6 86.65 39.76 89.78 91.53 268.08 119.54 258.17 48.6 86.65" style="fill:#ffffff;"/>
                            <ellipse cx="33.21" cy="58.86" rx="19.74" ry="41.53"
                                     transform="translate(-17.74 14.46) rotate(-19.5)" style="fill:#ffffff;"/>
                        </g>
                    </svg>
                    <span class="text-2xl font-bold text-white">Dishly</span>
                </a>

                <!-- Links -->
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-white hover:text-gray-200">Home</a>
                    <a href="{{ route('recipes.index') }}" class="text-white hover:text-gray-200">Recipes</a>
                    <a href="#" class="text-white hover:text-gray-200">About</a>
                    <a href="#" class="text-white hover:text-gray-200">Contact</a>
                </nav>

                <!-- Auth -->
                <div class="hidden md:flex items-center gap-4">
                    @if(Auth::check())
                        @include('layouts.partials.avatar')
                        @php
                          $email = auth()->user()->email;
                          $name = Str::before($email, '@');
                        @endphp
                        <span class="text-white hover:text-red-600">Hi, {{ $name }}</span>
                        <!-- Avatar -->
                        <form action="{{ route('logout') }}" method="POST" class="inline ">
                            @csrf
                            <button type="submit" class="text-white hover:text-gray-200">Logout</button>
                        </form>
                    @else
                        <button 
                            @click="loginOpen = true" 
                            class="text-white font-medium {{ request()->routeIs('recipes.show') ? 'text-white hover:text-gray-300' : 'text-white hover:text-gray-300' }}">
                            Login
                        </button>    
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-2 py-1 rounded-md">Sign Up</a>
                    @endif
                </div>

                <!-- Hamburger -->
                <button @click="mobileOpen = true" class="md:hidden text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
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
             class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

        <!-- Sidebar -->
        <div x-show="mobileOpen"
             x-transition:enter="transform transition ease-in-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transform transition ease-in-out duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="relative bg-green-700 text-white w-64 p-6 space-y-4">
            <button @click="mobileOpen = false" class="absolute top-4 right-4 text-white">
                ✕
            </button>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
              <path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/>
            </svg>
            <a href="{{ route('home') }}" class="block hover:text-gray-200">Home</a>
            <a href="{{ route('recipes.index') }}" class="block hover:text-gray-200">Recipes</a>
            <a href="#" class="block hover:text-gray-200">About</a>
            <a href="#" class="block hover:text-gray-200">Contact</a>
            @if(Auth::check())
                <a href="#" class="block hover:text-gray-200">
                    <div class="flex justify-between">
                        <form action="{{ route('logout') }}" method="POST" class="inline ">
                            @csrf
                            <button type="submit" class="text-white hover:text-gray-200">Logout</button>
                        </form>
                            <img src="{{ Auth::user()->avatar }}" 
                            alt="{{ Auth::user()->name }}" class="w-6 h-6 rounded-full border border-gray-300">
                    </div>
                </a>
            @else
                <button 
                    @click="loginOpen = true" 
                    class="text-gray-600 font-medium {{ request()->routeIs('recipes.show') ? 'text-white hover:text-gray-200' : 'text-white hover:text-gray-200' }}">
                    Login
                </button>    
                <a href="{{ route('register') }}" class="text-white py-1 rounded-md block">Sign Up</a>
            @endif
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
