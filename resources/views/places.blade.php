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
                    <h3 class="text-lg font-semibold mb-4">List of Saved Cities</h3>

                    @if ($cities->isEmpty())
                        <p class="text-gray-600">No cities registered. Add one to view weather information.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($cities as $city)
                            <li class="bg-white p-4 rounded-lg shadow-md hover:bg-gray-50 transition">
                                <!-- Nom de la ville cliquable qui redirige vers la page météo -->
                                {{ $city->place->name }}
                                <div class="mt-4 flex space-x-4">
                                    <!-- Vérifie si la ville est marquée comme favorite -->
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

                                        <!-- Bouton pour s'abonner aux rapports journaliers -->
                                        <button 
                                            class="px-4 py-2 text-sm font-medium text-black bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none">
                                            Receive a daily report
                                        </button>

                                        <!-- Formulaire pour supprimer la ville enregistrée -->
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
