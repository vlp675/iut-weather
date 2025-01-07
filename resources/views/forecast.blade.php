<x-app-layout>
    <x-slot name="header">
        <!-- Header displaying "Places" title -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forecast') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Display header for saved cities list -->
                    <h3 class="text-lg font-semibold mb-4">Forecast of {{$weather['city']['name']}}</h3>

                    <!-- Loop through the forecast data and display each day's weather details -->
                    @for ($i = 0; $i < 40 ; $i+=8)
                        <div class="mb-4 p-4 border rounded-lg shadow-md">
                            <h2>{{ date('l \t\h\e jS \a\t H:i', $weather['list'][$i]['dt']) }}</h2>
                            <p class="">Température : {{$weather['list'][$i]['main']['temp']}}°C</p>
                            <p class="">Conditions : {{$weather['list'][$i]['weather'][0]['description']}}</p>
                            <p class="">Humidité : {{$weather['list'][$i]['main']['humidity']}}%</p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
