<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="text-indigo-100 hover:bg-gray-700 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium" type="submit">
        <x-svg svg="logout" class="h-6 w-6" />
        Log out
    </button>
</form>
