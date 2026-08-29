<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RESTful API Routes (v1)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {
    Route::get('/profile', [ApiController::class, 'profile']);
    Route::get('/projects', [ApiController::class, 'projects']);
    Route::get('/projects/{identifier}', [ApiController::class, 'project']);
    Route::get('/experiences', [ApiController::class, 'experiences']);
    Route::get('/skills', [ApiController::class, 'skills']);
    Route::post('/contact', [ApiController::class, 'contact'])->middleware('throttle:5,1');
});

