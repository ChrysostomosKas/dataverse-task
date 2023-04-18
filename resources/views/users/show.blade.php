<x-app-layout title=''>

    <div
        class="grid max-w-3xl grid-cols-1 gap-6 mx-auto mt-8 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">
            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between">
                        <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">
                            {{ __('User Information') }}
                        </h2>
                        <span
                            class="text-l font-medium leading-6 text-{{ $user->is_active == 1 ? 'green' : 'red' }}-600">{{ $user->is_active == 1 ? __('Active') : __('Inactive') }}</span>
                    </div>
                    <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    {{ __('Name') }}
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->name ?? 'Not Given' }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    {{ __('Username') }}
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->usename ?? 'Not Given' }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    {{ __('Email') }}
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->email ?? 'Not Given' }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                </div>
            </section>
        </div>

        <section aria-labelledby="roles-list" class="lg:col-start-3 lg:col-span-1">
            <div class="bg-white rounded-lg shadow">
                <div class="p-4">
                    <h2 class="px-3 py-3 text-lg font-medium text-gray-900 border-b border-gray-200">{{ __('Roles') }}</h2>
                    <div class="mt-6 flow-root overflow-auto min-h-[300px] max-h-[300px]">
                        <ul role="list" class="-my-4 divide-y divide-gray-200">
                            @forelse($user->roles as $role)
                                <li class="flex items-center py-4 space-x-3">
                                    <div class="flex-shrink-0">
                                        <x-svg svg="user-circle" class="w-8 h-8 text-gray-500 rounded-full"/>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ __($role->name) }}
                                        </p>
                                    </div>
                                </li>
                            @empty
                                <li class="flex items-center py-4 space-x-3">
                                    <div class="w-full pt-10 text-center">
                                        <div wire:loading.remove
                                             class="flex flex-col justify-center text-base font-semibold text-gray-700">
                                            <x-svg class="w-8 h-8 mx-auto" svg='search'/>
                                            <span>{{ __('There are no results.') }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

</x-app-layout>
