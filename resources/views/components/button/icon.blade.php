@props(['icon', 'color' => 'blue'])

@php
    $class = 'inline-flex items-center p-2 text-white transition border border-transparent rounded-full shadow-sm bg-' . $color . '-600 hover:bg-' . $color .'-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-' . $color .'-500';
@endphp

@if($attributes['href'])
    <a {{ $attributes->merge(['class' => $class]) }}>
        <x-svg svg="{{ $icon }}" class="w-4 h-4 -ml"/>
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $class]) }}>
        <x-svg svg="{{ $icon }}" class="w-4 h-4 -ml"/>
    </button>
@endif
