<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/search', [CityController::class, 'search']);

Route::get('/city/{city}', [CityController::class, 'show']);


