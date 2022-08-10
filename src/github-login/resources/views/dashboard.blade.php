<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2>{{ $user['name'] }}</h2>
                <h4>{{ $user['email'] }}</h4>
                @if (isset($user['github_id']))
                    <h4>Github id: {{ $user['github_id'] }}</h4>
                @else
                    <h4>Logged not with github</h4>
                @endif
            </div>
            <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log out</a>
        </div>
    </div>
</x-app-layout>
