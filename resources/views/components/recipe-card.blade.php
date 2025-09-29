@props(['recipe', 'layout' => 'grid'])

@php
  $randomHeights = [
    'min-h-60', 'min-h-64', 'min-h-72', 'min-h-80', 
    'min-h-96', 'min-h-[28rem]', 'min-h-[32rem]', 'min-h-[36rem]'
  ];
  $randomHeight = $layout === 'masonry' 
      ? $randomHeights[array_rand($randomHeights)] 
      : 'min-h-72';
@endphp

{{-- GRID + MASONRY --}}
@if (in_array($layout, ['grid', 'masonry']))
  <a href="{{ route('recipes.show', $recipe) }}"
     class="group block bg-white rounded-lg shadow hover:shadow-lg overflow-hidden 
            transition-transform transform hover:scale-[1.02] duration-200
            {{ $layout === 'masonry' ? $randomHeight : '' }}">

    <!-- Image -->
    <img src="{{ $recipe->image_url ?? 'https://via.placeholder.com/300x200' }}"
         alt="{{ $recipe->title }}"
         class="w-full object-cover {{ $layout === 'masonry' ? $randomHeight : 'h-48' }}">

    <!-- Content -->
    <div class="p-4 flex flex-col justify-between h-48">
      <h3 class="text-lg font-semibold truncate" title="{{ $recipe->title }}">
        {{ Str::limit($recipe->title, 40) }}
      </h3>
      <p class="text-sm text-gray-500 mb-2 truncate">
        {{ Str::limit($recipe->category ?? 'Uncategorized', 20) }}
      </p>

      @php
        $average = $recipe->ratings()->avg('score') ?? 0;
        $count = $recipe->ratings()->count();
      @endphp
      <div class="flex flex-row items-center gap-2 mb-3" data-recipe-id="{{ $recipe->id }}">
        <div class="text-sm text-gray-700">
          @if ($count > 0)
            {{ number_format($average, 1) }} out of 5 ({{ $count }} {{ Str::plural('vote', $count) }})
          @else
            No votes yet
          @endif
        </div>
      </div>

      <!-- CTA -->
      <span class="flex items-center gap-2 w-full rounded-lg py-2 px-4 text-center text-sm font-bold 
                   text-green-600 bg-green-100 group-hover:bg-green-200 transition-all">
        View Recipe
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </span>
    </div>
  </a>
@endif

{{-- THUMBNAIL GALLERY --}}
@if ($layout === 'thumbs')
  <div class="space-y-4 ">
      <a href="{{ route('recipes.show', $recipe) }}"
         class="block bg-white rounded-md shadow hover:shadow-md overflow-hidden 
                transition-transform duration-200 hover:scale-[1.02]">

        <!-- Thumbnail Image -->
        <div class="w-full h-32">
          <img src="{{ $recipe->image_url ?? 'https://via.placeholder.com/150x100' }}"
               alt="{{ $recipe->title }}"
               class="w-full h-full object-cover">
        </div>

        <!-- Content -->
        <div class="p-2">
          <h3 class="text-sm font-semibold truncate">{{ $recipe->title }}</h3>
          <p class="text-xs text-gray-500 truncate">{{ $recipe->category ?? 'Uncategorized' }}</p>
        </div>
      </a>
  </div>
@endif

