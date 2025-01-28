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

// Registration route
Route::get('/register', function () {
    return view('register');
});

// Login route
Route::get('/login', function () {
    return view('login');
});

// Dashboard of iut-weather
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route to get the weather of a city
Route::post('/dashboard', [WeatherController::class, 'showWeather'])->name('weather.show');

// Route to get all the cities of a user
Route::get('/getCity', [CityController::class, 'getCity'])->name('getCity');

// Route to save a city for a user
Route::post('/saveCity', [CityController::class, 'saveCity'])->name('saveCity');

// Route to display/get all the weather of a city on a long term
Route::post('/forecastCity', [ForecastController::class, 'forecastCity'])->name('forecastCity');

// Route to get the CSV for a city
Route::post('/csvCity', [CsvController::class, 'csvCity'])->name('csvCity');

// Route to delete the city of a user
Route::delete('/removeCity', [CityController::class, 'removeCity'])->name('removeCity');

// Route to remove Favorite City
Route::delete('/removeFavoriteCity', [CityController::class, 'removeFavoriteCity'])->name('removeFavoriteCity');

// Route to add Favorite City
Route::post('/addFavoriteCity', [CityController::class, 'addFavoriteCity'])->name('addFavoriteCity');

// Route to unsubscribe to daily weather reports
Route::delete('/unsubscribeToDailyReport', [CityController::class, 'unsubscribeToDailyReport'])->name('unsubscribeToDailyReport');

// Route to Subscribe to daily weather reports
Route::post('/subscribeToDailyReport', [CityController::class, 'subscribeToDailyReport'])->name('subscribeToDailyReport');

// Routes about user profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__.'/auth.php';
