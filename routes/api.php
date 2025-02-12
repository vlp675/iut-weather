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

// API route to add the user a place
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::post('/users/places', [ApiUserPlaceController::class, 'addUserPlace'])->name('api.addUserPlace');
});

// API route to delete the user place
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::delete('/users/places', [ApiUserPlaceController::class, 'removeUserPlace'])->name('api.removeUserPlace');
});

// API route to toggle forecast of the city of a user
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::patch('/users/places/{place}/send-forecast', [ApiUserPlaceController::class, 'toggleSendForecast'])->name('api.toggleSendForecast');
});

// API route to toggle favorite of the city of a user
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::patch('/users/places/{place}/favorite', [ApiUserPlaceController::class, 'toggleFavorite'])->name('api.toggleFavorite');
});
