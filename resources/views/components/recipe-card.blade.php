<a href="{{ route('recipes.show', $recipe) }}"
   class="group block bg-white rounded-lg shadow hover:shadow-lg overflow-hidden transition-transform transform hover:scale-[1.02] duration-200">

  <!-- Image with gradient overlay -->
  <div class="relative w-full h-48">
    <img src="{{ $recipe->image_url ?? 'https://via.placeholder.com/300x200' }}"
         alt="{{ $recipe->title }}"
         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">

    <!-- Gradient overlay -->
  </div>

  <!-- Content -->
  <div class="p-4 flex flex-col justify-between h-48">
    <!-- Title -->
    <h3 class="text-lg font-semibold truncate" title="{{ $recipe->title }}">
      {{ Str::limit($recipe->title, 40) }}
    </h3>

    <!-- Category -->
    <p class="text-sm text-gray-500 mb-2 truncate" title="{{ $recipe->category }}">
      {{ Str::limit($recipe->category ?? 'Uncategorized', 20) }}
    </p>

    <!-- Ratings block -->
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
      <div class="flex ml-2">
        @for ($i = 1; $i <= 5; $i++)
          <svg xmlns="http://www.w3.org/2000/svg"
               class="w-4 h-4 ml-1 {{ $i <= round($average) ? 'text-yellow-400' : 'text-gray-300' }}"
               fill="currentColor" viewBox="0 0 24 24">
            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519
                     4.674a1 1 0 00.95.69h4.915c.969
                     0 1.371 1.24.588 1.81l-3.976
                     2.888a1 1 0 00-.363 1.118l1.518
                     4.674c.3.922-.755 1.688-1.538
                     1.118l-3.976-2.888a1 1 0
                     00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1
                     1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1
                     1 0 00.951-.69l1.519-4.674z" />
          </svg>
        @endfor
      </div>
    </div>

    <!-- CTA Button -->
    <div>
      <span
        class="flex items-center gap-2 w-full rounded-lg py-2 px-4 text-center text-sm font-bold text-green-600 bg-green-100 group-hover:bg-green-200 transition-all">
        View Recipe
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-4 w-4 ml-auto transform transition-transform group-hover:translate-x-1"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </span>
    </div>
  </div>
</a>
