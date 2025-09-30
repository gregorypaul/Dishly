@extends('layouts.app')

@section('content')
  <!-- Hero Section -->
  <section class="relative h-80 md:h-[28rem] bg-gray-700 text-white overflow-hidden">
    <img src="/images/plate-trans.webp" alt="About Dishly Hero" 
         class="absolute inset-0 w-full h-full object-cover opacity-70">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-6">
      <h1 class="text-4xl md:text-5xl font-bold">About Dishly</h1>
      <p class="mt-4 text-lg md:text-xl max-w-2xl">
        Discover, share, and save recipes from around the world.
      </p>
    </div>
  </section>

  <!-- Content Section -->
  <section class="relative max-w-6xl mx-auto px-6 py-16 space-y-20">

    <!-- Our Story -->
    <div 
      x-data="{ show: false }" 
      x-init="setTimeout(() => show = true, 200); window.addEventListener('scroll', () => { 
          if ($el.getBoundingClientRect().top < window.innerHeight - 100) show = true 
      })"
      class="grid md:grid-cols-2 gap-12 items-center transform transition duration-700 md:-mt-24"
      :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
      
      <div>
        <h2 class="text-3xl font-semibold text-gray-900 mb-4">Our Story</h2>
        <p class="text-gray-700 leading-relaxed">
          Dishly was created with a simple mission: to bring people together through food. 
          Whether you're a home cook experimenting in your kitchen or a professional chef sharing your 
          expertise, Dishly is the place to showcase and discover recipes that inspire.
        </p>
      </div>
      <div class="relative">
        <img src="/images/donut.avif" alt="Donut" 
             class="rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-pink-200 rounded-lg -z-10"></div>
      </div>
    </div>

    <!-- What We Do -->
    <div 
      x-data="{ show: false }" 
      x-init="window.addEventListener('scroll', () => { 
          if ($el.getBoundingClientRect().top < window.innerHeight - 100) show = true 
      })"
      class="grid md:grid-cols-2 gap-12 items-center transform transition duration-700 delay-150"
      :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
      
      <div class="relative order-2 md:order-1">
        <img src="/images/steak.avif" alt="Steak" 
             class="rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
        <div class="absolute -top-6 -right-6 w-28 h-28 bg-yellow-200 rounded-lg -z-10"></div>
      </div>
      <div class="order-1 md:order-2">
        <h2 class="text-3xl font-semibold text-gray-900 mb-4">What We Do</h2>
        <p class="text-gray-700 leading-relaxed">
          Our platform allows users to upload their favorite recipes, rate dishes, and save collections 
          of recipes for later. With thousands of dishes across categories, there's always something new 
          to explore and enjoy.
        </p>
      </div>
    </div>

    <!-- Join Our Community -->
    <div 
      x-data="{ show: false }" 
      x-init="window.addEventListener('scroll', () => { 
          if ($el.getBoundingClientRect().top < window.innerHeight - 100) show = true 
      })"
      class="text-center transform transition duration-700 delay-300"
      :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
      
      <h2 class="text-3xl font-semibold text-gray-900 mb-4">Join Our Community</h2>
      <p class="text-gray-700 leading-relaxed max-w-2xl mx-auto">
        We believe food is best when shared. Join our growing community of food lovers and be a part 
        of something delicious.
      </p>
      <div class="relative mt-10 inline-block">
        <img src="/images/burger.avif" alt="Burger"
             class="rounded-lg shadow-lg w-72 mx-auto transform hover:scale-105 transition duration-300">
        <div class="absolute -top-6 -left-6 w-20 h-20 bg-blue-200 rounded-lg -z-10"></div>
      </div>
    </div>

  </section>

  <!-- Newsletter -->
  <section class="relative py-16 px-6 sm:px-12 bg-gray-50" 
           style="background-image: url('/images/gradient-background-vector-spring-green_53876-117272.jpg'); background-size:cover; background-position: top right">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white/20 backdrop-blur-xl border border-white/30 rounded-2xl shadow-2xl shadow-gray-300/40 p-10 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Get Weekly Recipes in Your Inbox</h2>
        <p class="text-gray-700 mb-8">Join our newsletter and never miss a delicious new recipe!</p>
        <form action="#" method="POST" class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <input type="email" placeholder="Enter your email" 
                 class="w-full sm:w-auto flex-1 px-5 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600">
          <button type="submit" 
                  class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg transition">
            Subscribe
          </button>
        </form>
      </div>
    </div>
  </section>
@endsection
