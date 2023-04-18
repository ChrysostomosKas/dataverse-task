<x-app-layout title=''>

    <div>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center mb-4">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">{{ __('Users') }}</h1>
                </div>
                <div class="flex justify-end">
                    <x-button.link href="{{ route('users.create') }}">{{ __('New User') }}</x-button.link>
                </div>
            </div>

            <x-table color='gray'>

                <x-slot name="head">
                    <x-table.heading class="text-left">{{ __('Name') }}</x-table.heading>
                    <x-table.heading class="text-left">{{ __('Username') }}</x-table.heading>
                    <x-table.heading class="text-center">{{ __('Status') }}</x-table.heading>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Ενέργειες</span>
                    </th>
                </x-slot>

                <x-slot name="body">
                    @forelse ($users as $user)
                        <x-table.row class="overflow-hidden hover:bg-indigo-100 group">
                            <x-table.cell>
                                <div class="text-gray-900">{{ $user->name ?? '-' }}</div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="text-gray-900">{{ $user->username ?? '-' }}</div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex justify-center">
                                    <div class="flex flex-shrink-0">
                                        <p class="inline-flex rounded-full bg-{{ $user->is_active == 1 ? 'green' : 'red' }}-100 px-2 text-xs font-semibold leading-5 text-{{ $user->is_active == 1 ? 'green' : 'red' }}-800">{{ $user->is_active == 1 ? __('Active') : __('Inactive') }}</p>
                                    </div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex justify-end space-x-1 text-right">
                                    <x-button.tooltip url="{{  route('users.show', $user->id) }}" icon="eye"
                                                      color="gray">{{ __('Show') }}
                                    </x-button.tooltip>
                                    <x-button.tooltip url="{{  route('users.edit', $user->id) }}" icon="pencil"
                                                      color="indigo">{{ __('Edit') }}
                                    </x-button.tooltip>
                                    <div class="relative" x-data="{ tooltip: false }" x-on:mouseover="tooltip = true"
                                         x-on:mouseleave="tooltip = false">
                                        <button id="delete-user"
                                                data-user-id="{{ $user->id }}"
                                                data-csrf-token="{{ csrf_token() }}"
                                                data-modal-show="popup-modal"
                                                class="inline-flex items-center p-2 text-white transition border border-transparent rounded-full shadow-sm bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <x-svg svg="trash" class="w-4 h-4 -ml"/>
                                        </button>
                                        <div x-cloak x-show="tooltip"
                                             class="absolute top-0 p-2 text-sm text-white transform -translate-y-10 bg-gray-400 rounded-lg w-fit right-8 translate-x-7">{{ __('Delete') }}</div>
                                    </div>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="10">
                                <div class="flex items-center justify-center font-semibold text-gray-600">
                                    {{ __('There are no results...') }}
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>

        <script>
            $(document).on('click', '#delete-user', function () {
                var userId = $(this).data('user-id');
                var csrfToken = $(this).data('csrf-token');

                const dispatch = function (name, detail) {
                    const event = new CustomEvent(name, {detail});
                    window.dispatchEvent(event);
                }

                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: "{{ url('dashboard/delete/user') }}/" + userId,
                        type: 'POST',
                        data: {_token: csrfToken},
                        success: function (response) {
                            dispatch('notification', {message: response.message, success: true});

                            setTimeout(function () {
                                location.reload();
                            }, 2500);
                        },
                        error: function (response) {
                            dispatch('notification', {message: response.responseJSON.error, success: false});
                        }
                    });
                }
            });
        </script>
    </div>

</x-app-layout>
