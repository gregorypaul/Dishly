<a href="{{ route('home') }}" class="flex items-center gap-2">
    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 123.65 268.08">
        <g>
            <polygon points="94.42 90.69 85.61 87.47 11.91 257.88 39.82 268.08 94.42 90.69"
                     style="fill:{{ $variant === 'white' ? '#ffffff' : '#dc2626' }}"/>
            <ellipse cx="100.26" cy="59.46" rx="41.53" ry="19.74"
                     transform="translate(9.99 133.22) rotate(-69.92)"
                     style="fill:{{ $variant === 'white' ? '#ffffff' : '#dc2626' }}"/>
        </g>
        <g>
            <polygon points="48.6 86.65 39.76 89.78 91.53 268.08 119.54 258.17 48.6 86.65"
                     style="fill:{{ $variant === 'white' ? '#ffffff' : '#dc2626' }}"/>
            <ellipse cx="33.21" cy="58.86" rx="19.74" ry="41.53"
                     transform="translate(-17.74 14.46) rotate(-19.5)"
                     style="fill:{{ $variant === 'white' ? '#ffffff' : '#dc2626' }}"/>
        </g>
    </svg>

    <span class="text-2xl font-bold {{ $variant === 'white' ? 'text-white' : 'text-red-600' }}">
        Dishly
    </span>
</a>