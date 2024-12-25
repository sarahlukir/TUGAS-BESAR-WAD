<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\PersonalDataController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('personal_data', PersonalDataController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [JobVacancyController::class, 'dashboard'])->name('dashboard');
});

require __DIR__ . '/auth.php';