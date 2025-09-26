@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
<section class="relative p-5 sm:p-0 h-600px sm:h-[800px] bg-cover bg-center" style="background-image: url(/images/hero.jpg);">
    <div class="absolute inset-0 bg-white bg-opacity-5"></div>
    <div class="bg-white/50 backdrop-blur-sm blurr p-8 h-[40%] flex flex-col sm:flex-row justify-center lg:justify-start items-center w-[100%] md:w-[100%] relative">
        <div class="text-center lg:text-left">
            <h1 class="text-4xl md:text-6xl tracking-tighter font-bold mb-4 text-gray-900">Welcome to <span class="logo-text text-green-700 text-4xl md:text-7xl tracking-wide">Dishly</span></h1>
            <p class="text-lg mb-6">Discover, share, and save your favorite recipes.</p>
            <a href="{{ route('recipes.index') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg">
                Browse Recipes
            </a>
        </div>
    </div>
</section>

<!-- Featured Recipes Section -->
<section class="py-16 bg-gray-50">
    <div class="sm:max-w-3xl lg:max-w-full mx-auto px-3 sm:px-2 lg:px-20">
        <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Featured Recipes</h2>

        <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
            @foreach($featuredRecipes->take(5) as $recipe)
                <div class="recipe-card flex flex-col bg-white rounded-2xl shadow-lg hover:shadow-xl transition">
                  <a style="cursor: pointer" href="{{ route('recipes.show', $recipe) }}"     
                    <!-- Image (rounded top corners only) -->
                    <div class="relative">
                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}"
                             class="w-full object-cover rounded-t-2xl relative z-1">
                        <!-- Optional badge/date -->
                        <span class="absolute top-3 right-3 bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-lg">
                            {{ $recipe->created_at->format('M d, Y') }}
                        </span>
                                            <!-- Card Body (rounded bottom corners only) -->
                        <div class="recipe-card-body flex-1 relative -mt-6 z-20 bg-white p-4 rounded-b-2xl rounded-l-2xl w-100">
                            <h3 class="text-2xl font-semibold text-green-700 mb-2">{{ $recipe->title }}</h3>
                            @foreach($recipe->tags as $tag)
                                <span class="bg-green-600 text-white px-1 py-1 rounded-md text-xs ml-1">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                            <p class="text-2xl text-gray-600 mb-4">{{ Str::limit($recipe->description, 80) }}</p>
                            <p class="text-sm text-gray-600 mb-4">{{ Str::limit(implode(', ', $recipe->ingredients), 80) }}</p>
                        </div>
                    </div>
                    <div class="mt-auto p-4">
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
                  </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Signup Section -->
<section class="relative py-16 px-6 sm:px-12 bg-gray-50" style="background-image: url('/images/gradient-background-vector-spring-green_53876-117272.jpg'); background-size:cover; background-postion: top right">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white/20 backdrop-blur-xl border border-white/30 rounded-2xl shadow-2xl shadow-gray-300/40 p-10 text-center">
            
            <!-- Heading -->
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Get Weekly Recipes in Your Inbox
            </h2>
            <p class="text-gray-700 mb-8">
                Join our newsletter and never miss a delicious new recipe!
            </p>

            <!-- Form -->
            <form action="#" method="POST" class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <input 
                    type="email" 
                    placeholder="Enter your email" 
                    class="w-full sm:w-auto flex-1 px-5 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600"
                >
                <button 
                    type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg transition">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section>
@endsection