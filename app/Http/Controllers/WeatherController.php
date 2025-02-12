<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    // Constructor to initialize API key and base URL from the configuration
    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');
    }

    // Fetch and display weather information for a given city
    public function showWeather(Request $request, $cityName = null)
    {
        // Get the city name from the request input
        $cityName = $request->input('cityName');

        // Make an API call to fetch weather data
        $response = Http::get("{$this->baseUrl}weather", [
            'q' => $cityName,
            'appid' => $this->apiKey,
            'units' => 'metric', 
            'lang' => 'fr' 
        ]);

        // Make an API call to get the coordinates of the city
        $responseCoord = Http::get("http://api.openweathermap.org/geo/1.0/direct", [
            'q' => $cityName,
            'appid' => $this->apiKey,
            'limit' => 1
        ]);

        // If the API call is successful, display the weather data and the coordinates
        if ($response->successful() && $responseCoord->successful()) {
            $weatherData = $response->json();
            $weatherCoord = $responseCoord->json();
            return view('dashboard', [
                'weather' => $weatherData,
                'coordinates' => $weatherCoord
            ]);
        } else {
            // If the API call fails, return an error message
            return view('dashboard', [
                'weather' => null,
                'error' => 'Impossible de récupérer les données météorologiques.'
            ]);
        }
    }
}
