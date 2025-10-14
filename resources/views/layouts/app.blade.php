<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel Recipe App') }}</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <link rel="icon" type="image/x-icon" href="https://gregorypauldesigns.com/favicon.ico">
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  <body class="bg-gray-50 text-gray-900 {{ Str::slug(Route::currentRouteName()) }}" x-data="{ mobileOpen: false, loginOpen: false, registerOpen: false }">
    <!-- Transparent Hero Nav -->
    @php
      $darkRoutes = ['recipes/*', 'about', 'contact'];
      $navMode = request()->is(...$darkRoutes) ? 'dark' : 'light';
    @endphp

    <x-nav-hero :mode="$navMode" />

    <!-- Sticky Green Nav -->
    <x-nav-sticky :mode="$navMode" />

    <!-- Sidebar -->
    <x-nav-mobile :mode="$navMode"/>
      
    <!-- Page Content -->
    <main class="{{ Str::slug(Route::currentRouteName(), '-') }}">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Login Modal -->  
    <x-login-modal overlayColor="bg-black bg-opacity-80" />
    <x-register-modal overlayColor="bg-black bg-opacity-80" />

  </body>
</html>
