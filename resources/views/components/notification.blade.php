<div
    x-data="{ open:false, message:'', success:true }"

    aria-live="assertive" class="fixed inset-0 z-50 flex items-end w-auto px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
    <div
        x-cloak
        x-show='open'
        @notification.window="
      open=true;
      message = event.detail.message
      success = event.detail.success
      setTimeout(() => open = false, 3000)
    "
        x-transition.duration.350ms
        class="flex flex-col items-center w-full space-y-4 sm:items-end">

        <div class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <x-svg x-show='success === true' class="w-6 h-6 text-green-400" svg='circle-check' />
                        <x-svg x-show='success === false' class="w-6 h-6 text-red-400" svg='circle-x' />
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p x-html="success ? '{{ __('success') }}' : '{{ __('failure') }}'" class="text-sm font-medium text-gray-900"></p>
                        <p x-html="{{ __('message') }}" class="mt-1 text-sm text-gray-500"></p>
                    </div>
                    <div class="flex flex-shrink-0 ml-4">
                        <button @click="open = false" type="button" class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

