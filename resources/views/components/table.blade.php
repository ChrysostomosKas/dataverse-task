@props([
'overflow' => 'auto',
'color' => 'gray'
])
<div class="shadow overflow-{{ $overflow }} border-b border-gray-200 sm:rounded-lg z-0">

    <table class="min-w-full divide-y divide-gray-200">

        <thead class="bg-{{ $color }}-800">

        <tr>

            {{ $head }}

        </tr>

        </thead>


        <tbody class="bg-white divide-y divide-gray-200">

        {{ $body }}

        </tbody>

    </table>

</div>
