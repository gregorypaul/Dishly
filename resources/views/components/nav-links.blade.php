@props(['variant' => 'dark', 'layout' => 'horizontal'])

@php
    $linkClasses = $variant === 'white'
        ? 'text-white hover:text-red-200'
        : 'text-gray-700 hover:text-red-600';

    $containerClasses = $layout === 'vertical'
        ? 'flex flex-col space-y-4'
        : 'hidden md:flex space-x-6';
@endphp

<nav class="{{ $containerClasses }}">
    <a href="{{ route('home') }}" class="{{ $linkClasses }}">Home</a>
    <a href="{{ route('recipes.index') }}" class="{{ $linkClasses }}">Recipes</a>
    <a href="#" class="{{ $linkClasses }}">About</a>
    <a href="#" class="{{ $linkClasses }}">Contact</a>
</nav>