<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserPlaceRessource;
use App\Models\Places;
use Illuminate\Http\Request;
use App\Models\UserPlaces;
use Illuminate\Support\Facades\Auth;

class ApiUserPlaceController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    // Constructor to initialize API key and base URL from the configuration
    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');
    }

    // Get the cities of the user
    public function getUserPlace()
    {
        // Get the user Id
        $userId = Auth::id();

        // Display the results with a pagination
        $cities = UserPlaces::with('place')->where('user_id', $userId)->paginate(10);

        // Return the places of the user who's connected thank's to the token
        return UserPlaceRessource::collection($cities);
    }

    public function addUserPlace(Request $request)
    {
        // Get the user Id
        $userId = Auth::id();

        // Get the parameter from the body
        $place = $request->input("place");

        if (!$place) {
            return "You need to choose a city in the body of your request (use the \"place\" parameter) !";
        }

        // Find in the database the place choosed by the user from the params
        $placeEntity = Places::where('name', $place)->first();
        $placeId = $placeEntity->id;

        // Check if the user as already the city in his Places
        $userPlaces = UserPlaces::where('user_id', $userId)
            ->where('place_id', $placeId)
            ->first();

        if (!$userPlaces) {
            // Add the city to the user places
            UserPlaces::create([
                'user_id' => $userId,
                'place_id' => $placeId,
                'is_favorite' => false,
                'send_forecast' => false
            ]);
        }
    }

    public function removeUserPlace(Request $request)
    {
        // Get the user Id
        $userId = Auth::id();

        // Get the parameter from the body
        $place = $request->input("place");

        if (!$place) {
            return "You need to choose a city in the body of your request (use the \"place\" parameter) !";
        }

        // Find in the database the place choosed by the user from the params
        $placeEntity = Places::where('name', $place)->first();
        $placeId = $placeEntity->id;

        // Create a new record in UserPlaces
        UserPlaces::where('user_id', $userId)
            ->where('place_id', $placeId)
            ->delete();
    }

    public function toggleSendForecast($place)
    {
        // Get the user Id
        $userId = Auth::id();

        // Find in the database the place choosed by the user from the params
        $placeEntity = Places::where('name', $place)->first();
        $placeId = $placeEntity->id;

        // Get the actual state of the boolean "send_forecast" from the database
        $forecastState = UserPlaces::where('user_id', $userId)
            ->where('place_id', $placeId)
            ->first()
            ->send_forecast;

        // Change the boolean "send_forecast" from the database
        UserPlaces::where('user_id', $userId)
            ->where('place_id', $placeId)
            ->update(['send_forecast' => $forecastState ? false : true]);
    }

    public function toggleFavorite($place)
    {
        // Get the user Id
        $userId = Auth::id();

        // Find in the database the place choosed by the user from the params
        $placeEntity = Places::where('name', $place)->first();
        $placeId = $placeEntity->id;

        // Get the actual state of the boolean "is_favorite" from the database
        $favoriteState = UserPlaces::where('user_id', $userId)
            ->where('place_id', $placeId)
            ->first()
            ->is_favorite;

        // Change the boolean "is_favorite" from the database
        // If the choosen city is not the favorite
        if (!$favoriteState) {
            // Remove any existing favorite city for the user
            UserPlaces::where('user_id', $userId)
                ->where('is_favorite', true)
                ->update(['is_favorite' => false]);

            // Mark the selected city as favorite
            UserPlaces::where('user_id', $userId)
                ->where('place_id', $placeId)
                ->update(['is_favorite' => true]);
        } else {
            // If the choosen city is already the favorite
            UserPlaces::where('user_id', $userId)
                ->where('place_id', $placeId)
                ->update(['is_favorite' => false]);
        }
    }
}
