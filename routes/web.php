<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\CsvController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

// Weather
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard', [WeatherController::class, 'showWeather'])->name('weather.show');

// Cities
Route::get('/getCity', [CityController::class, 'getCity'])->name('getCity');

// Save Cities
Route::post('/saveCity', [CityController::class, 'saveCity'])->name('saveCity');

// Forecast Cities
Route::post('/forecastCity', [ForecastController::class, 'forecastCity'])->name('forecastCity');

// CSV Cities
Route::post('/csvCity', [CsvController::class, 'csvCity'])->name('csvCity');

// Remove Cities
Route::delete('/removeCity', [CityController::class, 'removeCity'])->name('removeCity');

// Remove Favorite Cities
Route::delete('/removeFavoriteCity', [CityController::class, 'removeFavoriteCity'])->name('removeFavoriteCity');

// Add Favorite Cities
Route::post('/addFavoriteCity', [CityController::class, 'addFavoriteCity'])->name('addFavoriteCity');

// Unsubscribe to daily weather reports
Route::delete('/unsubscribeToDailyReport', [CityController::class, 'unsubscribeToDailyReport'])->name('unsubscribeToDailyReport');

// Subscribe to daily weather reports
Route::post('/subscribeToDailyReport', [CityController::class, 'subscribeToDailyReport'])->name('subscribeToDailyReport');

// User
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__.'/auth.php';
