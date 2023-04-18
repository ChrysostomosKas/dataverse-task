@props([
'leadingAddOn' => false,
])


<div class="relative flex shadow-sm">

    @if ($leadingAddOn)

        <span class="inline-flex items-center px-3 text-gray-500 border border-r-0 border-gray-300 rounded-l-md bg-gray-50 sm:text-sm">

            {{ $leadingAddOn }}

        </span>
    @endif

    <input {{ $attributes->merge(['class' => 'sm:text-sm border border-gray-300 focus:outline-none focus:shadow-none focus:ring-offset-2 focus:placeholder-indigo-400 focus:border-indigo-500 pl-4 shadow-sm transition py-2 w-full' . ($leadingAddOn ? ' rounded-none rounded-r-md' : ' rounded ')]) }} />
</div>
