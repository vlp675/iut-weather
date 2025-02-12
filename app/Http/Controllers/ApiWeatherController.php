<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\WeatherRessource;
use App\Http\Resources\ForecastRessource;
use Illuminate\Support\Facades\Http;

class ApiWeatherController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    // Constructor to initialize API key and base URL from the configuration
    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');
    }

    // Get current weather data for a specific city
    public function getWeather(Request $request)
    {
        // Validate the input
        $request->validate([
            'place' => 'string|max:255',
        ]);

        $city = $request->input('place');

        // Send a request to the OpenWeather API to get current weather
        $response = Http::get($this->baseUrl."weather", [
            'q' => $city,
            'appid' => $this->apiKey, 
            'units' => 'metric', 
            'lang' => 'fr'
        ]);

        if ($response->successful()) {
            // Return the weather data
            return new WeatherRessource($response->json());
        } else {
            // Return an error message if the API request fails
            return "error";
        }
    }

    // Get weather forecast data for a specific city
    public function getForecast(Request $request)
    {
        // Validate the input
        $request->validate([
            'place' => 'string|max:255',
        ]);

        // Get the city name from the request
        $city = $request->input('place');

        // Send a request to the OpenWeather API to get weather forecast
        $response = Http::get($this->baseUrl."forecast", [
            'q' => $city, 
            'appid' => $this->apiKey,
            'units' => 'metric', 
            'lang' => 'fr' 
        ]);

        if ($response->successful()) {
            // Return the forecast weather
            return new ForecastRessource($response->json());
        } else {
            // Return an error message if the API request fails
            return "error";
        }
    }
}
