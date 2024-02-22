<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/index',                                        [App\Http\Controllers\API\User\AuthController::class, 'index']);

Route::post('/signup',                                      [App\Http\Controllers\API\User\AuthController::class, 'signup']);
Route::post('/login',                                       [App\Http\Controllers\API\User\AuthController::class, 'login']);


// shoppiing mall controller

Route::post('/admin/createCategory',                        [App\Http\Controllers\API\Admin\ShoppingMallController::class, 'createCategory']);
Route::get('/admin/getCategories',                          [App\Http\Controllers\API\Admin\ShoppingMallController::class, 'getCategories']);


Route::get('/user/getCategories',                           [App\Http\Controllers\API\User\ShoppingMallController::class, 'getCategories']);
