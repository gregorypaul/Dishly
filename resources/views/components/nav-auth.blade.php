@props([
  'linkColor' => 'text-white/50', 
  'hoverColor' => 'hover:text-white',
  'buttonBg' => 'bg-green-600',
  'buttonText' => 'text-white',
  'buttonHoverText' => 'text-gray-300',
  'buttonHoverBg' => 'hover:bg-green-700',
  'layout' => 'horizontal',
])

@php
    $authClasses = "{$linkColor} {$hoverColor}";
    $containerClasses = $layout === 'vertical'
        ? 'flex flex-col space-y-4'
        : 'hidden md:flex space-x-6 items-center';
    $buttonClasses = "{$buttonBg} {$buttonHoverBg} {$buttonText} {$buttonHoverText} px-2 py-1 rounded-md";
@endphp

<div class="{{ $containerClasses }}">
    @auth
        <div x-data="{ open: false }" class="relative">
            <!-- Avatar + name trigger -->
            <button @click="open = ! open" class="flex items-center space-x-2 focus:outline-none">
                @include('layouts.partials.avatar', ['size' => 32])
                <span class="{{ $authClasses }}">Hi, {{ auth()->user()->name ?? Str::before(auth()->user()->email, '@') }}</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div 
                x-show="open" 
                @click.away="open = false"
                x-transition
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
            >
                <a href="{{ route('show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Profile
                </a>
                <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Settings
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    @else
        <button @click="loginOpen = true" class="{{ $buttonClasses }} text-center">
            Login
        </button>    
        <a href="{{ route('register') }}" class="{{ $buttonClasses }} text-center">
            Sign Up
        </a>
    @endauth
</div>
