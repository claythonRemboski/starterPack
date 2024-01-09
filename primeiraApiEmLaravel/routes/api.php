<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ZipcodeController;
use Illuminate\Support\Facades\Route;


Route::apiResource('/users', UserController::class );

Route::delete('/zipcode/{id}', [ZipcodeController::class, 'destroy']);
Route::patch('/zipcode/{id}', [ZipcodeController::class, 'update']);
Route::get('/zipcode/{id}', [ZipcodeController::class, 'show']);
Route::get('/zipcode', [ZipcodeController::class, 'index']);
Route::post('/zipcode', [ZipcodeController::class, 'store']);

