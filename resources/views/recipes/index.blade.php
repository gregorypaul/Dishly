@extends('layouts.app')

@php
  $categoryIcons = [
      'Beef' => 'beef',
      'Chicken' => 'drumstick',
      'Vegetarian' => 'leaf',
      'Pasta' => 'utensils-crossed',
      'Dessert' => 'ice-cream',
      'Starter' => 'cooking-pot',
      'Miscellaneous' => 'shopping-cart',
      'Side' => 'salad',
      'Fish' => 'fish-symbol',
      'Seafood' => 'shrimp',
      'Breakfast' => 'egg',
      'Pork' => 'ham',
      'Lamb' => 'drumstick',
      'Goat' => 'drumstick',
      'Vegan' => 'vegan',
  ];
@endphp

@section('content')
  <div x-data="{ collapsed: true }" class="mt-20 flex">

    <!-- Sidebar -->
    <aside :class="collapsed ? 'w-16' : 'w-64'"
      class="flex flex-col border-r border-gray-200 transition-all duration-300 ease-in-out z-30">
      <!-- Collapse Toggle -->
      <div class="flex justify-between items-center px-2 py-3 border-b">
        <h2 x-show="!collapsed" class="text-lg font-semibold">Categories</h2>
        <button @click="collapsed = !collapsed"
          class="p-1 w-8 h-8 flex items-center justify-center text-gray-500 hover:text-gray-800">
          <i data-lucide="chevron-left" class="w-5 h-5 transform transition-transform duration-300"
            :class="{ 'rotate-180': collapsed }"></i>
        </button>
      </div>

      <!-- Categories -->
      <nav class="space-y-2 p-2 flex-1">
        <a href="{{ route('recipes.index', ['layout' => $layout]) }}"
          class="group relative flex items-center px-2 py-2 rounded-md 
          {{ request('category') ? 'text-gray-700 hover:bg-gray-100' : 'bg-green-100 text-green-700 font-semibold' }}">
          <i data-lucide="utensils" class="w-5 h-5"></i>
          <span x-show="!collapsed" class="ml-2">All Recipes</span>
          <!-- Tooltip -->
          <span x-show="collapsed"
            class="absolute left-12 top-1/2 -translate-y-1/2 px-2 py-1 rounded bg-gray-800 text-white text-xs opacity-0 group-hover:opacity-100 transition">
            All Recipes
          </span>
        </a>

        @foreach ($categories as $category => $count)
          <a href="{{ route('recipes.index', ['category' => $category, 'layout' => $layout]) }}"
            class="group relative flex items-center px-2 py-2 rounded-md
          {{ request('category') === $category
           ? 'bg-green-100 text-green-700 font-semibold'
           : 'text-gray-700 hover:bg-gray-100' }}">
            <i data-lucide="{{ $categoryIcons[$category] ?? 'utensils' }}" class="w-5 h-5 text-gray-600"></i>
            <span x-show="!collapsed" class="ml-2">{{ $category }} ({{ $count }})</span>

            <!-- Tooltip when collapsed -->
            <span x-show="collapsed"
              class="absolute left-12 top-1/2 -translate-y-1/2 px-2 py-1 rounded bg-gray-800 text-white text-xs opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
              {{ $category }} ({{ $count }})
            </span>
          </a>
        @endforeach
      </nav>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 w-full overflow-hidden transition-all duration-300">
      <!-- Layout Toggle -->
      <div class="flex justify-end mb-4 gap-2">
        <a href="{{ route('recipes.index', array_merge(request()->all(), ['layout' => 'grid'])) }}"
        class="px-3 py-1 rounded flex items-center gap-1 {{ $layout === 'grid' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
        <i data-lucide="grid"></i>
          </a>

          <a href="{{ route('recipes.index', array_merge(request()->all(), ['layout' => 'masonry'])) }}"
            class="px-3 py-1 rounded flex items-center gap-1 {{ $layout === 'masonry' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
            <i data-lucide="layout"></i>
          </a>

          <a href="{{ route('recipes.index', array_merge(request()->all(), ['layout' => 'thumbs'])) }}"
            class="px-3 py-1 rounded flex items-center gap-1 {{ $layout === 'thumbs' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
            <i data-lucide="list"></i>
          </a>
      </div>
        <h1 class="self-start mr-auto items-center text-2xl font-bold mb-6 inline-flex">Recipes</h1>

      @if ($recipes->count())
        @if ($layout === 'masonry')
          <div class="mb-3 hidden md:flex gap-5">
            {{ $recipes->links() }}
          </div>
          <div class="columns-1 md:columns-2 lg:columns-3 xl:columns-4 gap-3">
            @foreach ($recipes as $recipe)
              <div class="mb-6 break-inside-avoid">
                <x-recipe-card :recipe="$recipe" layout="masonry" />
              </div>
            @endforeach
          </div>
        @elseif ($layout === 'thumbs')
          <div class="mb-3 hidden md:block">
            {{ $recipes->links() }}
          </div>
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 w-full">
            @foreach ($recipes as $recipe)
              <x-recipe-card :recipe="$recipe" layout="thumbs" />
            @endforeach
          </div>
        @else
          <div class="mb-3 hidden md:block">
            {{ $recipes->links() }}
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full">
            @foreach ($recipes as $recipe)
              <x-recipe-card :recipe="$recipe" layout="grid" />
            @endforeach
          </div>
        @endif

        <div class="mt-6 block">
          {{ $recipes->links() }}
        </div>
      @else
        <p>No recipes found.</p>
      @endif
    </main>
  </div>
@endsection
