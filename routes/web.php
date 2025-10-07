<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutritionController;

Route::get('/', function () {
    return view('nutrition/index');
});

Route::get('/nutrition', [NutritionController::class, 'index'])->name('nutrition.index');
Route::post('/nutrition', [NutritionController::class, 'analyze'])->name('nutrition.analyze');
