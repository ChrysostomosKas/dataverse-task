@props(['url' => false, 'icon' => 'pencil', 'color' => 'zinc', 'onclick' => ''])

<div class="relative" x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
    <x-button.icon
        href="{{ $url }}"
        icon="{{ $icon }}"
        color="{{ $color }}"
        @click="{{ $onclick }}"/>
    <div x-cloak x-show="tooltip"
         class="absolute top-0 p-2 text-sm text-white transform -translate-y-10 bg-gray-400 rounded-lg w-fit right-8 translate-x-7">{{ $slot }}</div>
</div>
