<?php

use App\Http\Controllers\EnviromentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/ambiente', EnviromentController::class);
Route::post('/ambiente-on-off/{id}', [EnviromentController::class, 'updateStatus']);
Route::post('/ambiente/{id}', [EnviromentController::class, 'updateName']);