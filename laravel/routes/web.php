<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/places', function () {
    return view('places');
})->name('places');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');
