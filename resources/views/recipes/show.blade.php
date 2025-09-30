@extends('layouts.app')

@section('content')
  <!-- Hero Section -->
  <section class="details relative h-[35vh] w-full">
    <!-- Background Image -->
    <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="absolute inset-0 w-full h-full object-cover" />
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Right-Aligned Info -->
    <div class="relative z-10 h-full flex items-center justify-end px-6 md:px-16">
      <div class="text-right text-white w-full">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $recipe->title }}</h1>
        @php
          $average = $recipe->ratings()->avg('score') ?? 0;
          $count = $recipe->ratings()->count();
        @endphp
        <!-- Badges for Ratings -->
        <div class="flex flex-row justify-end items-center gap-4" data-recipe-id="{{ $recipe->id }}">
          <div>
            <span class="w-50 inline-block m-0 p-0 avg-rating text-sm text-white overflow-x-hidden align-middle"
              data-avg="{{ number_format($recipe->ratings()->avg('score') ?? 0, 1) }}">
              @if ($count > 0)
                {{ number_format($average, 1) }} out of 5 (from {{ $count }} {{ Str::plural('vote', $count) }})
              @else
                0 votes
              @endif
            </span>
          </div>
          <div class="flex ml-3 items-center">
            @for ($i = 1; $i <= 5; $i++)
              <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 ml-1 star cursor-pointer transition-colors duration-200 
                  {{ $i <= round($recipe->ratings()->avg('score')) ? 'text-yellow-400' : 'text-gray-600' }}"
                data-score="{{ $i }}" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1
                              0 00.95.69h4.915c.969 0 1.371 1.24.588
                              1.81l-3.976 2.888a1 1 0 00-.363
                              1.118l1.518 4.674c.3.922-.755 1.688-1.538
                              1.118l-3.976-2.888a1 1 0 00-1.176
                              0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1
                              1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1
                              1 0 00.951-.69l1.519-4.674z" />
              </svg>
            @endfor
          </div>
        </div>
        <div class="block ml-2 avg-rating text-sm text-white">
          @if (!auth()->check())
            <p class="block text-sm text-white mt-1">Login to rate this recipe.</p>
          @endif
        </div>

        <!-- Badges for Tags Info -->
        @if (!empty($recipe->tags))
          <div class="flex gap-2 mt-3 justify-end">
            @foreach ($recipe->tags as $tag)
              <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                {{ $tag->name }}
              </span>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <section class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">
    <!-- Left Column -->
    <div class="md:col-span-2 space-y-10">
      <!-- Ingredients -->
      <div
        class="w-full md:max-w-max bg-white md:bg-black shadow-none md:shadow-lg rounded-xl p-6 mt-auto md:-mt-40 z-11 relative">
        <h2 class="text-2xl font-bold text-gray-800 md:text-white mb-4">Ingredients</h2>
        <ul class="space-y-2 list-disc pl-6 text-gray-700 md:text-white">
          @foreach ($recipe->ingredients as $index => $ingredient)
            <li>
              {{ $ingredient }}
              @if (!empty($recipe->measures[$index]))
                - {{ $recipe->measures[$index] }}
              @endif
            </li>
          @endforeach
        </ul>
      </div>

      <!-- Instructions -->
      <div>
        <h2 class="text-2xl font-bold mb-4">Instructions</h2>
        <ol class="space-y-6 list-decimal list-inside">
          @foreach ($recipe->instructions as $step)
            <li>{{ $step }}</li>
          @endforeach
        </ol>
      </div>
      <p class="mt-4 text-gray-700">
        @if (!empty($recipe->source))
          Source: <span class="text-sm">{{ $recipe->source }}</span>
        @endif
      </p>
      @if (!empty($recipe->youtube))
        <div class="mt-8">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-2xl font-bold mb-4">Watch the Recipe Video</h3>

            <div class="relative h-0 overflow-hidden w-full rounded-lg shadow-lg" style="padding-bottom: 56.25%;"
              {{-- 16:9 ratio --}}>
              <iframe src="{{ str_replace('watch?v=', 'embed/', $recipe->youtube) }}" frameborder="0" allowfullscreen
                class="absolute top-0 left-0 w-full h-full"></iframe>
            </div>

            <p class="mt-4 text-gray-700">
              Learn how to prepare this dish step by step in this helpful video guide.
            </p>
          </div>
        </div>
      @endif


    </div>

    <!-- Sidebar -->
    <aside class="bg-white rounded-md shadow-sm space-y-6">
      @if (isset($relatedRecipes))
        <div class="rounded-xl p-6">
          <h3 class="text-xl font-semibold mb-4">
            {{ $title }}
          </h3>
          <div class="space-y-4">
            @foreach ($relatedRecipes as $related)
              <a href="{{ route('recipes.show', $related->id) }}" class="block">
                <div class="flex items-center gap-4">
                  <img src="{{ $related->image_url }}" alt="{{ $related->title }}"
                    class="w-16 h-16 object-cover rounded-lg">
                  <span class="font-medium">{{ $related->title }}</span>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      @endif
    </aside>
  </section>
@endsection
