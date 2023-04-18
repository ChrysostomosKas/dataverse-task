<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-full">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <section aria-labelledby="profile-overview-title">
                <div class="rounded-lg bg-white overflow-hidden shadow-lg">
                    <div class="bg-white p-6">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-5">
                                <div class="flex-shrink-0">
                                    <x-user-avatar src="{{ auth()->user()->avatarUrl() }}"/>
                                </div>
                                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                    <p class="text-sm font-medium text-gray-600">{{ __('Welcome back,') }}</p>
                                    <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ auth()->user()->name }}</p>
                                    <p class="text-sm font-medium text-gray-500">
                                            <span class="text-gray-900">
                                                @foreach (auth()->user()->roles as $role)
                                                    {{ __($role->name) }},
                                                @endforeach
                                            </span>
                                    </p>
                                    <div>
                                        <span class="inline-flex items-center rounded-full
                                               bg-{{ auth()->user()->is_active == 1 ? 'green' : 'red' }}-100 px-2.5 py-0.5 text-xs font-medium text-{{ auth()->user()->is_active == 1 ? 'green' : 'red' }}-800">{{ auth()->user()->is_active == 1 ?  __('Active') : __('Inactive') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 flex justify-center sm:mt-0">
                                <a href="{{ route('users.show', auth()->user()->id) }}"
                                   class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                     {{ __('View profile') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</x-app-layout>
