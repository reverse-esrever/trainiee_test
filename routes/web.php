<?php

use App\Http\Controllers\GeoController;
use Illuminate\Support\Facades\Route;

require_once "auth.php";

Route::middleware('auth')->group(function(){
    Route::get('/', [GeoController::class,'index'])->name('/');
    Route::get('/geo', [GeoController::class,'index'])->name('geo.index');
    Route::post('/geo', [GeoController::class,'store'])->name('geo.store');
    Route::get('/geo/{coords}', [GeoController::class,'show'])->name('geo.show');
});
