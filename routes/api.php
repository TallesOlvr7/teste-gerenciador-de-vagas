<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\VacancyController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::post('/auth',[AuthController::class,'auth']);
    Route::post('/users',[UserController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/logout',[AuthController::class,'logout']);
        Route::apiResource('users',UserController::class)->except(['index','store']);
    });

    Route::middleware(['auth:sanctum','abilities:candidate-token'])->group(function(){ 
        Route::apiResource('vacancies',VacancyController::class)->only(['index','show']);
        Route::post('/apply',[UserController::class,'apply']);
    });

    Route::middleware(['auth:sanctum','abilities:recruiter-token'])->group(function(){
        Route::get('/users',[UserController::class,'index']);
        Route::apiResource('vacancies',VacancyController::class);
        Route::patch('/cancel', [VacancyController::class, 'cancel']);
    });
});
