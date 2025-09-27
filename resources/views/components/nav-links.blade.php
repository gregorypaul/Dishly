@props([
  'linkColor', 
  'hoverColor',
  'layout' => 'horizontal',
  ])

@php
    $linkColor = $linkColor ?? 'text-gray-700';
    $hoverColor = $hoverColor ?? 'hover:text-red-600';
    $linkClasses = "{$linkColor} {$hoverColor}";
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