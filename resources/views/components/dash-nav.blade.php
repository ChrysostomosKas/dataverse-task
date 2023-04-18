@props([
'currentPeriodStatus' => ''
])

<div class="sticky top-0 z-10 flex flex-shrink-0 h-16 bg-white shadow">
    <div class="flex items-center justify-between flex-1 px-4">
        <div class="flex flex-1 space-x-2">

            <div x-data="{open:false}" class="relative inline-block">
                <button @click="open=true"
                        class="flex items-center justify-between px-4 py-2 font-medium text-gray-700 bg-gray-100 border border-gray-200 rounded-md hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2"
                        aria-haspopup="true" aria-expanded="false">
                            <span>
                                {{ app()->getLocale() == 'en' ? 'English' : 'Ελληνικά' }}
                            </span>
                    <span class="ml-1">
                        <x-svg class="w-4 h-4 transition-transform duration-150 transform pointer-events-none" svg="arrow-down" />
                    </span>
                </button>
                <ul x-show='open'
                    @click.away='open=false'
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-10 py-1 mt-2 overflow-hidden bg-white rounded-md shadow-md">
                    <li>
                        <a href="{{ route('lang.switch', 'en') }}"
                           class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:text-gray-900">
                            <span>
                                {{ __('English') }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('lang.switch', 'gr') }}"
                           class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:text-gray-900">
                            <span>
                                {{ __('Ελληνικά') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>


        </div>

        <div class="flex items-center ml-4 md:ml-6">
            <x-dropdown>
                <x-slot name='trigger'>
                    <x-button.dropdown-trigger id="user-menu-button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->avatarUrl() }}"
                             alt="User {{ Auth::user()->name }} Avatar">
                    </x-button.dropdown-trigger>
                </x-slot>

                <x-dropdown-link href="{{ route('users.show', Auth::id()) }}" tabindex="-1" id="user-menu-item-0">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <x-dropdown-link href="{{ route('users.edit', Auth::id()) }}" tabindex="-1" id="user-menu-item-1">
                    {{ __('Settings') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link href="#" tabindex="-1" id="user-menu-item-2"
                                     onclick="event.preventDefault();
                        this.closest('form').submit();"
                    >
                        {{ __('Logout') }}
                    </x-dropdown-link>

                </form>

            </x-dropdown>
        </div>
    </div>
</div>
