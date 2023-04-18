@props(['svg'])
<svg {{ $attributes }} width="20" height="20">
    <use xlink:href="{{ asset('tabler-sprite.svg').'#tabler-'.$svg }}" />
</svg>
