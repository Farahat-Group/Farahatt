<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ServicesController;
use Illuminate\Support\Facades\Route;


//Auth Routes

Route::controller(AuthController::class)->group(function () {
    Route::post('login' ,'login');
    Route::post('register' , 'register');
    Route::get('profile' , 'getProfile')->middleware('auth:api');
    Route::post('profile' , 'updateProfile')->middleware('auth:api');
});

//Auth Routes




Route::middleware('auth:api')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories' , 'index');
        Route::get('categories/{id}' , 'show');
        Route::get('categories/{category}/services' , 'services');
    });

    Route::controller(ServicesController::class)->group(function () {
        Route::get('services' , 'index');
        Route::get('services/{id}' , 'show');
        Route::get('bestsellers' , 'bestsellers');
    });
});
