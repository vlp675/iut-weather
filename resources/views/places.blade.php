<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Places') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Component management -->
                    <h1>Weather Information</h1>
                    <p>City: {{ $weather['name'] }}</p>
                    <p>Temperature: {{ $weather['main']['temp'] }}°C</p>
                    <p>Weather: {{ $weather['weather'][0]['description'] }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
