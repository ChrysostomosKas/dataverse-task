@props([
'title' => 'Some Title',
'subtitle' => 'Some Subtitle'
])
<div {{ $attributes }} class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">

        <x-form.info-block :title="$title">
            {{ $subtitle }}
        </x-form.info-block>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 space-y-6 bg-white sm:p-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
