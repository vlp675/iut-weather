<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\WeatherRessource;
use Illuminate\Support\Facades\Http;

class ApiWeatherController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');
    }

    public function getWeather(Request $request)
    {
        $request->validate([
            'place' => 'string|max:255',
        ]);

        $city = $request->input('place');

        $response = Http::get($this->baseUrl . "weather", [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang' => 'fr'
        ]);

        if ($response->successful()) {
            // Return view with data
            return new WeatherRessource($response->json());
        } else {
            return "error";
        }
    }

    public function getForecast(Request $request) 
    {
        $request->validate([
            'place' => 'string|max:255',
        ]);

        $city = $request->input('place');

        $response = Http::get($this->baseUrl . "forecast", [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang' => 'fr'
        ]);

        if ($response->successful()) {
            // Return view with data
            return new WeatherRessource($response->json());
        } else {
            return "error";
        }
    }
}
