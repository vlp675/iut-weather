<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiWeatherController;
use App\Http\Controllers\ApiUserPlaceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API route to get the weather of a city
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/weather', [ApiWeatherController::class, 'getWeather'])->name('api.weather');
});

// API route to get the forecast
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/forecast', [ApiWeatherController::class, 'GetForecast'])->name('api.forecast');
});

// API route to get the user saved places
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/users/places', [ApiUserPlaceController::class, 'getUserPlace'])->name('api.getUserPlace');
});

// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);
 
//     return ['token' => $token->plainTextToken];
// });
