<x-app-layout>
    <x-slot name="header">
        <!-- Dashboard Header -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Form to input city name and fetch weather -->
                    <form method="POST" action="{{ route('weather.show') }}">
                        @csrf 
                        <label for="cityName">Enter City Name:</label>
                        <input type="text" id="cityName" name="cityName" required class="border-gray-300 rounded-md">
                        <button type="submit" class="px-6 py-2 text-sky-500">Get Weather</button>
                    </form>

                    <!-- Display weather information if it exists -->
                    @if(isset($weather))
                        <h3 class="p-4"><b>Weather Information</b></h3>

                        <!-- Button to save the city information -->
                        <form method="POST" action="{{ route('saveCity') }}">
                            @csrf 
                            <button type="submit" name="saveCity" class="px-6 py-2 text-green-500 mt-4" value="{{$weather['name']}}">Save City</button>
                        </form>

                        <!-- Button to see the forecast information of the city -->
                        <form method="POST" action="{{ route('forecastCity') }}">
                            @csrf 
                            <button 
                                value="{{ $weather['name'] }}"
                                type="submit" 
                                name="forecastCity" 
                                class="px-6 py-2 text-green-500 mt-4">
                                See Forecast
                            </button>
                        </form>

                        <!-- Button to download the CSV -->
                        <form method="POST" action="{{ route('csvCity') }}">
                            @csrf 
                            <button 
                                value="{{ $weather['name'] }}"
                                type="submit" 
                                name="forecastCity" 
                                class="px-6 py-2 text-green-500 mt-4">
                                Download CSV
                            </button>
                        </form>

                        <!-- Weather details -->
                        <p><b>City:</b> {{ $weather['name'] }}</p>
                        <p><b>Temperature:</b> {{ $weather['main']['temp'] }}°C</p>
                        <p><b>Weather:</b> {{ $weather['weather'][0]['description'] }}</p>
                    @endif             
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
