<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiWeatherController;
use App\Http\Controllers\ApiUserPlaceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/weather', [ApiWeatherController::class, 'getWeather'])->name('api.weather');
});

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/forecast', [ApiWeatherController::class, 'GetForecast'])->name('api.forecast');
});

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/userplace', [ApiUserPlaceController::class, 'GetUserPlace'])->name('api.userplace');
});

// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);
 
//     return ['token' => $token->plainTextToken];
// });
