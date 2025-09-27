@props(['mode' => 'light'])

@php
    $isDark = $mode === 'dark';

    $logoColor = $isDark ? '#ffffff' : '#dc2626';
    $textColor = $isDark ? 'text-white' : 'text-red-600';

    $linkColor = $isDark ? 'text-white' : 'text-gray-700';
    $hoverColor = $isDark ? 'hover:text-red-600' : 'hover:text-red-600';

    $authColor = $linkColor; // keep it consistent
    $authHover = $hoverColor;

    $hamburgerColor = $isDark ? 'text-white' : 'text-gray-800';
@endphp

<header class="absolute top-0 w-full z-50 transition-transform duration-500 ease-ease">
    <div class="w-full mx-auto px-6 flex justify-between items-center py-4 {{ Str::slug(Route::currentRouteName(), '-') }}">
        <!-- Logo -->
        <x-nav-logo :logoColor="$logoColor" :textColor="$textColor" />

        <!-- Links -->
        <x-nav-links :linkColor="$linkColor" :hoverColor="$hoverColor" />

        <!-- Auth -->
        <x-nav-auth :linkColor="$authColor" :hoverColor="$authHover" />

        <!-- Hamburger -->
        <button @click="mobileOpen = true" class="md:hidden {{ $hamburgerColor }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</header>