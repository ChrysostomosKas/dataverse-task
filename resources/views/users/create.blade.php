<x-app-layout title=''>
    <div class="mt-8">

        <form id="create-user-form">
            @csrf
            <x-form.container
                title="{{ __('Personal Information') }}"
                subtitle=''>

                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6 sm:col-span-6">
                        <div class="relative flex items-start py-4 w-1/3">
                            <div class="flex items-center h-5 mr-3">
                                <input id="is_active"
                                       name="is_active" value="1" type="checkbox"
                                       class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            </div>
                            <div class="flex-1 min-w-0 text-sm">
                                <label for="is_active"
                                       class="font-medium text-gray-700 select-none">{{ __('Is Active') }}</label>
                            </div>
                            <div id="is_active-error" class="text-red-500"></div>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <x-input.group inline for='Name' :label="__('Name')">
                            <x-input.text name="name" id="name" placeholder="{{ __('Name') }}" required/>
                            <div id="name-error" class="text-red-500"></div>
                        </x-input.group>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <x-input.group inline for='Username' :label="__('Username')">
                            <x-input.text name="username" id="username" placeholder="{{ __('Username') }}" required/>
                            <div id="username-error" class="text-red-500"></div>
                        </x-input.group>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <x-input.group inline for='Password' :label="__('Password')">
                            <x-input type="password" id="password" name="password" required/>
                            <div id="password-error" class="text-red-500"></div>
                        </x-input.group>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <x-input.group inline for='password_confirmation' :label="__('Password Confirmation')">
                            <x-input type="password" name="password_confirmation"
                                     id="password_confirmation" required/>
                            <div id="password_confirmation-error" class="text-red-500"></div>
                        </x-input.group>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <x-input.group inline for='Email' :label="__('Email')">
                            <x-input.text name="email" id="Email" placeholder="" required/>
                            <div id="email-error" class="text-red-500"></div>
                        </x-input.group>
                    </div>

                </div>

            </x-form.container>

            <x-form.block-divider/>

            <x-form.container
                title="{{ __('Roles Assignment') }}"
                subtitle=''>

                <div class="px-4 py-5 space-y-6 bg-white sm:p-6">

                    <fieldset class="mt-6">
                        <legend class="text-lg font-medium text-gray-900">{{ __('Roles') }}</legend>
                        <div class="mt-4 border-t border-b border-gray-200 divide-y divide-gray-200">
                            @forelse ($roles as $role)
                                <div class="relative flex items-start py-4">
                                    <div class="flex-1 min-w-0 text-sm">
                                        <label for="selected_roles.{{ $role->id }}"
                                               class="font-medium text-gray-700 select-none">{{ __($role->name) }}</label>
                                    </div>
                                    <div class="flex items-center h-5 ml-3">
                                        <input id="selected_roles.{{ $role->id }}" name="selected_roles[]"
                                               value="{{ $role->id }}" type="checkbox"
                                               class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            <div id="selected_roles-error" class="text-red-500"></div>
                        </div>
                    </fieldset>
                </div>

            </x-form.container>

            <div class="flex justify-end py-3 pr-3 md:pr-0">
                <x-button.primary type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ __('Create') }}</x-button.primary>
            </div>
        </form>

        <script>
            $(document).ready(function () {
                $('#create-user-form').on('submit', function (e) {
                    e.preventDefault();

                    const dispatch = function (name, detail) {
                        const event = new CustomEvent(name, {detail});
                        window.dispatchEvent(event);
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('users.store') }}',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (response) {
                            dispatch('notification', {message: response.message, success: true});

                            setTimeout(function () {
                                window.location.href = "/dashboard/users";
                            }, 2000);

                        },
                        error: function (response) {
                            $.each(response.responseJSON.errors, function (key, value) {
                                $('#' + key + '-error').html(value);
                            });
                        }
                    });
                });
            });
        </script>


    </div>
</x-app-layout>
