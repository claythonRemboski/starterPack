<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ZipcodeController;
use Illuminate\Support\Facades\Route;


Route::apiResource('/users', UserController::class );

