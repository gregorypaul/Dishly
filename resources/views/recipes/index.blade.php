@extends('layouts.app')

@section('content')
<div class="flex mt-20">
  <!-- Sidebar -->
  <aside class="w-64 bg-white p-6 border-r border-gray-200">
    <h2 class="text-lg font-semibold mb-6 flex items-center space-x-2">Filters</h2>
    <form method="GET" action="{{ route('recipes.index') }}">
        <div class="space-y-2">
            @foreach($categories as $category => $count)
                <label class="flex items-center space-x-2">
                    <input 
                        type="radio" 
                        name="category" 
                        value="{{ $category }}" 
                        {{ request('category') === $category ? 'checked' : '' }}
                        onchange="this.form.submit()"
                    >
                    <span>{{ $category }} ({{ $count }})</span>
                </label>
            @endforeach
        </div>
    </form>
  </aside>

<!-- Main Content -->
<main class="flex-1 p-6">
  <h1 class="text-2xl font-bold mb-6">Recipes</h1>
  
  @if($recipes->count())
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach($recipes as $recipe)
    <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">
      <img src="{{ $recipe->image_url }}" 
      class="w-full h-48 object-cover" 
      alt="{{ $recipe->title }}">
      
      <div class="p-4 flex flex-col h-full">
        <h3 class="font-semibold text-lg mb-1">{{ $recipe->title }}</h3>
        <p class="text-sm text-gray-500 mb-2">{{ $recipe->category }}</p>
        
        <!-- Average rating stars -->
        <div class="flex items-center text-yellow-500 mb-3">
          @php $avg = round($recipe->ratings()->avg('score'), 1); @endphp
          @for ($i = 1; $i <= 5; $i++)
          <span>{{ $i <= $avg ? '★' : '☆' }}</span>
          @endfor
          <span class="ml-2 text-gray-600 text-sm">({{ $recipe->ratings()->count() }} votes)</span>
        </div>
        
        <a href="{{ route('recipes.show', $recipe) }}" 
        class="flex min-w-full select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold  text-green-500 transition-all md:bg-green-500/10 hover:bg-green-400/30 active:bg-green-400/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
        Read More
        <span class="ml-auto">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </span>
      </a>
    </div>
  </div>
  @endforeach
</div>

<!-- Pagination -->
<div class="mt-6">
  {{ $recipes->links() }}
</div>
@else
<p>No recipes found.</p>
@endif
</main>
</div>
@endsection
