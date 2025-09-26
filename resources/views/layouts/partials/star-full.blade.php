<svg xmlns="http://www.w3.org/2000/svg" 
     class="w-6 h-6 star cursor-pointer" 
     data-score="{{ $score }}" 
     viewBox="0 0 177.73 169.48">
  <defs>
    <linearGradient id="grad-full-{{ $score }}" x1="45.31" y1="84.49" x2="45.31" y2="259.03" gradientUnits="userSpaceOnUse">
      <stop offset="0" stop-color="#fdfce5"/>
      <stop offset=".44" stop-color="#e69d24"/>
    </linearGradient>
  </defs>
  <path d="M92.75,3.32l18.06,55.6c.55,1.68,2.11,2.82,
           3.88,2.82h58.46c3.95,0,5.59,5.06,2.4,7.38
           l-47.29,34.36c-1.43,1.04-2.03,2.88-1.48,4.56
           l18.06,55.6c1.22,3.76-3.08,6.88-6.28,4.56
           l-47.29-34.36c-1.43-1.04-3.37-1.04-4.79,0
           l-47.29,34.36c-3.2,2.32-7.5-.8-6.28-4.56
           l18.06-55.6c.55-1.68-.05-3.52-1.48-4.56
           L2.19,69.11c-3.2-2.32-1.55-7.38,2.4-7.38
           h58.46c1.77,0,3.33-1.14,3.88-2.82
           L84.99,3.32c1.22-3.76,6.54-3.76,7.76,0Z"
        style="fill:url(#grad-full-{{ $score }}); stroke:#fde966; stroke-miterlimit:10;"/>
</svg>