<!-- Avatar -->
  @if(Auth::user() && Auth::user()->avatar)
    <img 
        src="{{ auth()->user()->avatar }}" 
        alt="User Avatar" 
        class="rounded-full object-cover"
        width="{{ $size }}" 
        height="{{ $size }}"
    >
  @else
    <div 
        class="rounded-full bg-gray-300 flex items-center justify-center text-gray-600"
        style="width: {{ $size }}px; height: {{ $size }}px;"
    >
        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
    </div>
  @endif