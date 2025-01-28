<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRessource;
use Illuminate\Http\Request;
use App\Http\Resources\WeatherRessource;
use App\Models\UserPlaces;
use Illuminate\Support\Facades\Auth;

class ApiUserPlaceController extends Controller
{

    public function getUserPlace(Request $request)
    {
        $userId = Auth::id();

        $cities = UserPlaces::with('place')->where('user_id', $userId)->paginate();
        return UserRessource ::collection($cities);
    }
}
