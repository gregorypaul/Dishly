@php
  $average = $recipe->ratings()->avg('score') ?? 0;
  $count = $recipe->ratings()->count();
@endphp
<!-- Badges for Ratings -->
<div class="flex flex-row justify-end items-center gap-4" data-recipe-id="{{ $recipe->id }}">
<div>
  <span class="w-50 inline-block m-0 p-0 avg-rating text-sm text-white overflow-x-hidden align-middle"
    data-avg="{{ number_format($recipe->ratings()->avg('score') ?? 0, 1) }}">
    @if($count > 0)
      {{ number_format($average, 1) }} out of 5 (from {{ $count }} {{ Str::plural('vote', $count) }})
    @else
      0 votes
    @endif              
  </span>
</div>