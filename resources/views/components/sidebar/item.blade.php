@props(['active', 'count', 'icon'])

@php
    $classes = ($active ?? false )
                ? 'text-indigo-100 hover:bg-gray-900 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium'
                : 'text-indigo-100 hover:bg-gray-700 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if (isset($icon))
        <x-svg svg="{{ $icon }}" class="h-6 w-6" color="white"/>
    @endif
    {{ $slot }}
</a>
