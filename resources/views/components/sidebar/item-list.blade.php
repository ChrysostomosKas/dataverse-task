<x-sidebar.item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard*')" icon="home">{{ __('Dashboard') }}</x-sidebar.item>
<x-sidebar.item href="{{ route('users.index') }}" :active="request()->routeIs('users*')" icon="users">{{ __('Users') }}</x-sidebar.item>
