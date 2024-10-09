<?php

use App\Http\Controllers\API\V1\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::post('/auth',[AuthController::class,'auth']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/logout',[AuthController::class,'logout']);
    });
});
