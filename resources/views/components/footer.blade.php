<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 mt-16">
  <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
    
    <!-- Logo + tagline -->
    <div>
      <x-nav-logo logo-color="#dc2626" logo-text-color="text-white" />
      <p class="mt-3 text-sm text-gray-400">Discover, share, and save recipes from around the world.</p>
    </div>

    <!-- Links -->
    <div>
      <h3 class="text-white font-semibold mb-4">Quick Links</h3>
      <ul class="space-y-2 text-sm max-w-max">
        <x-nav-links linkColor="text-white/80" hoverColor="hover:text-white" layout="vertical" />
      </ul>
    </div>

    <!-- Categories -->
    <div>
      <h3 class="text-white font-semibold mb-4">Categories</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-white">Breakfast</a></li>
        <li><a href="#" class="hover:text-white">Lunch</a></li>
        <li><a href="#" class="hover:text-white">Dinner</a></li>
        <li><a href="#" class="hover:text-white">Desserts</a></li>
      </ul>
    </div>

    <!-- Socials -->
    <div>
  <h3 class="text-white font-semibold mb-4">Follow Us</h3>
  <div class="flex space-x-4">
    <!-- Facebook -->
    <a href="#" class="text-gray-400 hover:text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 5 3.657 9.127 8.438 9.878V15.47H7.898v-3.47h2.54V9.845c0-2.506 1.493-3.89 3.777-3.89 1.094 0 2.238.196 2.238.196v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562v1.86h2.773l-.443 3.47h-2.33v6.408C18.343 21.127 22 17 22 12z"/>
      </svg>
    </a>

    <!-- Twitter/X -->
    <a href="#" class="text-gray-400 hover:text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 0 0 1.88-2.38c-.84.5-1.77.85-2.75 1.05A4.27 4.27 0 0 0 16.11 4c-2.38 0-4.3 1.94-4.3 4.33 0 .34.03.67.1.98-3.57-.18-6.74-1.91-8.86-4.53-.37.65-.58 1.4-.58 2.2 0 1.52.76 2.86 1.9 3.65-.7 0-1.36-.2-1.94-.52v.05c0 2.13 1.5 3.9 3.5 4.3-.36.1-.74.15-1.13.15-.27 0-.54-.03-.8-.08.55 1.73 2.14 2.98 4.02 3.01a8.58 8.58 0 0 1-5.3 1.85c-.34 0-.67-.02-1-.06a12.09 12.09 0 0 0 6.56 1.93c7.87 0 12.17-6.57 12.17-12.26 0-.19 0-.37-.01-.56A8.83 8.83 0 0 0 22.46 6z"/>
      </svg>
    </a>

    <!-- Instagram -->
    <a href="#" class="text-gray-400 hover:text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zm-5 3.5A5.5 5.5 0 1 0 17.5 13 5.5 5.5 0 0 0 12 7.5zm0 2A3.5 3.5 0 1 1 8.5 13 3.5 3.5 0 0 1 12 9.5zM17.85 6.15a1 1 0 1 0 1.4 1.42 1 1 0 0 0-1.4-1.42z"/>
      </svg>
    </a>

    <!-- YouTube -->
    <a href="#" class="text-gray-400 hover:text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M23.5 6.2s-.2-1.6-.8-2.2c-.8-.9-1.7-.9-2.1-1C17.3 2.5 12 2.5 12 2.5h-.1s-5.3 0-8.6.5c-.5.1-1.3.1-2.1 1-.6.6-.8 2.2-.8 2.2S0 8.1 0 10v2c0 1.9.2 3.8.2 3.8s.2 1.6.8 2.2c.8.9 1.9.9 2.4 1 1.8.2 7.6.5 7.6.5s5.3 0 8.6-.5c.5-.1 1.3-.1 2.1-1 .6-.6.8-2.2.8-2.2s.2-1.9.2-3.8v-2c0-1.9-.2-3.8-.2-3.8zM9.5 14.5V9.5l6 2.5-6 2.5z"/>
      </svg>
    </a>
  </div>
</div>

  </div>

  <!-- Bottom bar -->
  <div class="border-t border-gray-800 py-6 text-center text-sm text-gray-500">
    © {{ date('Y') }} Dishly. All rights reserved.
  </div>
</footer>