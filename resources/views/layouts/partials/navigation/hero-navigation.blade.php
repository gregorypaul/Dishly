<header class="absolute top-0 w-full z-50 transition-transform duration-500 ease-ease">
  <div class="w-full mx-auto px-6 flex justify-between items-center py-4 {{ Str::slug(Route::currentRouteName(), '-') }}">
      <!-- Logo -->
      @include('layouts.partials.logo', ['variant' => request()->routeIs('recipes.show') ? 'white' : 'red'])

      <!-- Links -->
      @include('layouts.partials.nav-links', ['variant' => request()->routeIs('recipes.show') ? 'white' : 'dark'])

      <!-- Auth -->
      @include('layouts.partials.nav-auth', ['variant' => request()->routeIs('recipes.show') ? 'white' : 'dark'])

      <!-- Hamburger -->
      <button @click="mobileOpen = true" class="md:hidden {{ request()->routeIs('recipes.show') ? 'text-white' : 'text-gray-800' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
      </button>
  </div>
</header>