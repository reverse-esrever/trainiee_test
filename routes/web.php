<?php

use App\Http\Controllers\GeoController;
use Illuminate\Support\Facades\Route;

Route::controller(GeoController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/geo', 'index')->name('geo.index');
    Route::post('/geo', 'store')->name('geo.store');
    Route::get('/geo/{coords}', 'show')->name('geo.show');
});
