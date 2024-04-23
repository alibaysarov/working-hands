<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertismentController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::controller(AdvertismentController::class)->prefix('advertisment')
    ->group(function () {
        Route::get('/all', 'getAll');
        Route::get('/{id}', 'getOne');
        Route::post('/create', 'create');
    });
