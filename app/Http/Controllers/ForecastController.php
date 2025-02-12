<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    // Constructor to initialize API key and base URL from the configuration
    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');
    }

    // Fetch and display weather forecast for a given city
    public function forecastCity(Request $request)
    {
        // Get city ID
        $city_name = $request->input('forecastCity');

        // Make an API call to fetch weather forecast data
        $response = Http::get("{$this->baseUrl}forecast", [
            'q' => $city_name,
            'appid' => $this->apiKey,
            'units' => 'metric', 
            'lang' => 'fr'
        ]);

        // If the API call is successful, display the forecast data
        if ($response->successful()) {
            $weatherData = $response->json();
            return view('forecast', [
                'weather' => $weatherData,
            ]);
        } else {
            // If the API call fails, return an error message
            return view('dashboard', [
                'weather' => null,
                'error' => 'Unable to get weather forecast data.'
            ]);
        }
    } 
}
