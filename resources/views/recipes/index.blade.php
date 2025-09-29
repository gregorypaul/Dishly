@extends('layouts.app')

@section('content')
<div class="flex mt-20">

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

  <!-- Sidebar wrapper with Alpine -->
  <div x-data="{ open: false, collapsed: false }" class="flex mt-20">

  <!-- Sidebar -->
  <aside 
    :class="collapsed ? 'w-16' : 'w-64'"
    class="border-r border-gray-200
           transition-all duration-300 ease-in-out
           hidden sm:flex flex-col"
  >
    <!-- Collapse Toggle -->
    <div class="flex justify-between items-center px-4 py-3 border-b">
      <h2 x-show="!collapsed" class="text-lg font-semibold">Categories</h2>
      <button 
        @click="collapsed = !collapsed"
        class="p-1 w-8 h-8 flex items-center justify-center text-gray-500 hover:text-gray-800"
      >
        <i data-lucide="chevron-left" 
           class="w-5 h-5 transform transition-transform duration-300"
           :class="{ 'rotate-180': collapsed }"></i>
      </button>
    </div>

    <!-- Categories -->
    <nav class="space-y-2 p-4 flex-1 overflow-y-auto">
      <a href="{{ route('recipes.index') }}"
        class="flex items-center px-2 py-2 rounded-md 
        {{ request('category') ? 'text-gray-700 hover:bg-gray-100' : 'bg-green-100 text-green-700 font-semibold' }}">
        <i data-lucide="utensils" class="w-5 h-5"></i>
        <span x-show="!collapsed" class="ml-2">All Recipes</span>
      </a>

      @foreach ($categories as $category => $count)
        <a href="{{ route('recipes.index', ['category' => $category]) }}"
          class="flex items-center px-2 py-2 rounded-md 
            {{ request('category') === $category
                ? 'bg-green-100 text-green-700 font-semibold'
                : 'text-gray-700 hover:bg-gray-100' }}">
          <i data-lucide="{{ $categoryIcons[$category] ?? 'utensils' }}" class="w-5 h-5 text-gray-600"></i>
          <span x-show="!collapsed" class="ml-2">{{ $category }} ({{ $count }})</span>
        </a>
      @endforeach
    </nav>
  </aside>

  <!-- Mobile Sidebar (slide-in) -->
  <aside 
    x-show="open"
    x-transition
    class="fixed inset-y-0 left-0 w-64 border-r z-30 sm:hidden flex flex-col"
  >
    <div class="flex justify-between items-center px-4 py-3 border-b">
      <h2 class="text-lg font-semibold">Categories</h2>
      <button @click="open = false" class="text-gray-500 hover:text-gray-800">✕</button>
    </div>
    <nav class="space-y-2 p-4 flex-1 overflow-y-auto">
      <a href="{{ route('recipes.index') }}" class="flex items-center px-2 py-2 rounded-md 
        {{ request('category') ? 'text-gray-700 hover:bg-gray-100' : 'bg-green-100 text-green-700 font-semibold' }}">
        <i data-lucide="utensils" class="w-5 h-5"></i>
        <span>All Recipes</span>
      </a>
      @foreach ($categories as $category => $count)
        <a href="{{ route('recipes.index', ['category' => $category]) }}"
          class="flex items-center px-2 py-2 rounded-md 
            {{ request('category') === $category
                ? 'bg-green-100 text-green-700 font-semibold'
                : 'text-gray-700 hover:bg-gray-100' }}">
          <i data-lucide="{{ $categoryIcons[$category] ?? 'utensils' }}" class="w-5 h-5 text-gray-600"></i>
          <span>{{ $category }} ({{ $count }})</span>
        </a>
      @endforeach
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6 transition-all duration-300">
    <div class="-mt-3 block">
      {{ $recipes->links() }}
    </div>
    <h1 class="text-2xl font-bold mb-6">Recipes</h1>

    @if ($recipes->count())
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($recipes as $index => $recipe)
          <div 
            x-init="$el.classList.add('opacity-0', 'translate-y-4');
                     setTimeout(() => $el.classList.remove('opacity-0', 'translate-y-4'), {{ $index * 100 }})"
            class="transition-all duration-500"
          >
            <x-recipe-card :recipe="$recipe" />
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-6 block">
        {{ $recipes->links() }}
      </div>
    @else
      <p>No recipes found.</p>
    @endif
  </main>
</div>

@endsection
