<!-- Avatar -->
  @if(Auth::user() && Auth::user()->avatar)
    <img src="{{ Auth::user()->avatar }}" 
          alt="{{ Auth::user()->name }}" 
          class="w-6 h-6 rounded-full border border-gray-300">
  @else
    <div class="w-6 h-6 flex items-center justify-center rounded-full bg-gray-600 text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
      </svg>
    </div>
  @endif