<x-app-layout>
    <x-slot name="header">
        <!-- Header displaying "Places" title -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Places') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Display header for saved cities list -->
                    <h3 class="text-lg font-semibold mb-4">List of Saved Cities</h3>

                    <!-- If no cities are saved, show a message -->
                    @if ($cities->isEmpty())
                        <p class="text-gray-600">No cities registered. Add one to view weather information.</p>
                    @else
                        <ul class="space-y-4">
                            <!-- Loop through each saved city -->
                            @foreach ($cities as $city)
                            <li class="bg-white p-4 rounded-lg shadow-md hover:bg-gray-50 transition">
                                <!-- Display the city name, clickable to view weather -->
                                {{ $city->place->name }}
                                <div class="mt-4 flex space-x-4">
                                    
                                    <!-- Check if the city is marked as favorite -->
                                    @if ($city->is_favorite)
                                    <form action="{{ route('removeFavoriteCity') }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                        name="removeFavoriteCity"
                                        type="submit"
                                        value="{{ $city->place->id }}"
                                        class="px-4 py-2 text-sm font-medium text-black bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">
                                            Delete From Favorite
                                        </button>
                                    </form>
                                    @else
                                    <!-- Button to add city to favorites -->
                                    <form action="{{ route('addFavoriteCity') }}" method="POST" class="inline-block">
                                        @csrf
                                        <button
                                            name="addFavoriteCity"
                                            value="{{ $city->place->id }}"
                                            type="submit"
                                            class="px-4 py-2 text-sm font-medium text-black bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none">
                                            Add to Favorite
                                        </button>
                                    </form>
                                    @endif

                                    <!-- Button to subscribe to daily weather reports -->
                                    <button 
                                        class="px-4 py-2 text-sm font-medium text-black bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none">
                                        Receive a daily report
                                    </button>

                                    <!-- Form to delete the city from the saved list -->
                                    <form action="{{ route('removeCity') }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                        Delete
                                        </button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
