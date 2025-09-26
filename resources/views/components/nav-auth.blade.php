@props(['variant' => 'dark', 'layout' => 'horizontal'])

@php
    $textClasses = $variant === 'white'
        ? 'text-white hover:text-red-200'
        : 'text-gray-700 hover:text-red-600';

    $containerClasses = $layout === 'vertical'
        ? 'flex flex-col space-y-4 text-left'
        : 'hidden md:flex space-x-4 items-center';
@endphp

<div class="{{ $containerClasses }}">
    @auth
        @include('layouts.partials.avatar')
        @php
            $email = auth()->user()->email;
            $name = Str::before($email, '@');
        @endphp
        <span class="{{ $textClasses }}">Hi, {{ $name }}</span>

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="{{ $textClasses }}">Logout</button>
        </form>
    @else
        <button @click="loginOpen = true" class="{{ $textClasses }}">
            Login
        </button>    
        <a href="{{ route('register') }}" class="bg-green-600 text-white px-2 py-1 rounded-md">
            Sign Up
        </a>
    @endauth
</div>
