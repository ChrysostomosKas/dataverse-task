@props([
'leadingAddOn' => false,
])


<div class="flex rounded-md">

    @if ($leadingAddOn)

        <span class="items-center px-3 text-gray-500 border border-r-0 border-gray-300 rounded-l-md bg-gray-50 sm:text-sm">

            {{ $leadingAddOn }}

        </span>
    @endif

    <input type="checkbox" {{ $attributes->merge(['class' => 'shadow-sm border border-gray-300 focus:outline-none focus:shadow-none focus:ring-offset-2 focus:placeholder-indigo-400 focus:border-indigo-500 pl-4 rounded transition py-2 w-auto' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }}/>
</div>
