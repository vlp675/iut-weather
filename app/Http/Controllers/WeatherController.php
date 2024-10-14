<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');
    }

    public function showWeather(Request $request, $cityName = null)
    {
        $cityName = $request->input('cityName');

        $response = Http::get("{$this->baseUrl}weather", [
            'q' => $cityName,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang' => 'fr'
        ]);

        if ($response->successful()) {
            $weatherData = $response->json();
            return view('dashboard', [
                'weather' => $weatherData,
            ]);
        } else {
            return view('dashboard', [
                'weather' => null,
                'error' => 'Impossible de récupérer les données météorologiques.'
            ]);
        }
    }
}
