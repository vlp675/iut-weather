<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Places;
use App\Models\UserPlaces;

class CityController extends Controller
{
    // Save a city for the authenticated user
    public function saveCity (Request $request) {
        $name = $request->input('saveCity');
        $place = Places::where('name', $name)->first();
        
        // If the city doesn't exist, create it
        if (!$place) {
            $place = Places::create([
                'name' => $name
            ]);
        }

        $userId = Auth::id();
        $placeId = $place->id;

        // Link the city to the user if not already linked
        $userPlace = UserPlaces::where('place_id', $placeId)->where('user_id', $userId)->first();
        if (!$userPlace) {
            $userPlace = UserPlaces::create([
                'user_id' => $userId,
                'place_id' => $placeId,
                'is_favorite' => false,
                'send_forecast' => false
            ]);
        }

        // Redirect to the list of user's cities
        return redirect()->route('getCity');
    } 

    // Display all cities saved by the authenticated user
    public function getCity () {
        $userId = Auth::id();

        // Retrieve all user-related places with their details
        $cities = UserPlaces::with('place')->where('user_id', $userId)->get();
        return view('places', [
            'cities' => $cities,
        ]);
    } 

    // Delete a city (implementation pending)
    public function deleteCity (Request $request) {

    } 

    // Mark a city as the user's favorite
    public function addFavoriteCity (Request $request) {
        $city_id = $request->input('addFavoriteCity');
        $user_id = Auth::id();

        // Remove existing favorite city for the user
        UserPlaces::where('user_id', $user_id)
            ->where('is_favorite', true)
            ->update(['is_favorite' => false]);

        // Mark the selected city as favorite
        UserPlaces::where('user_id', $user_id)
            ->where('place_id', $city_id)
            ->update(['is_favorite' => true]);

        return redirect()->route('getCity')->with('status', 'Ville ajoutée aux favoris !');
    } 

    // Remove a city from the user's favorites
    public function removeFavoriteCity (Request $request) {
        $city_id = $request->input('removeFavoriteCity');
        $user_id = Auth::id();

        // Update the city to no longer be a favorite
        UserPlaces::where('user_id', $user_id)
            ->where('place_id', $city_id)
            ->update(['is_favorite' => false]);

        return redirect()->route('getCity')->with('status', 'Ville retirée des favoris !');
    } 
}
