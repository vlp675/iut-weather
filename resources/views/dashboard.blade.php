<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('weather.show') }}">
                        @csrf 
                        <label for="cityName">Enter City Name:</label>
                        <input type="text" id="cityName" name="cityName" required class="border-gray-300 rounded-md">
                        <button type="submit" class="px-6 py-2 text-sky-500">Get Weather</button>
                    </form>

                    @if(isset($weather))
                        <h3 class="p-4"><b>Weather Information</b></h3>
                        <p><b>City:</b> {{ $weather['name'] }}</p>
                        <p><b>Temperature:</b> {{ $weather['main']['temp'] }}°C</p>
                        <p><b>Weather:</b> {{ $weather['weather'][0]['description'] }}</p>
                    @endif             
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
