<?php

use App\Router\Route;

Route::get('/', [\App\Controllers\IndexController::class, 'index']);
Route::get('/login', [\App\Controllers\AuthController::class, 'login']);
Route::post('/login', [\App\Controllers\AuthController::class, 'auth']);
Route::get('/registration', [\App\Controllers\AuthController::class, 'registration']);
Route::post('/registration', [\App\Controllers\AuthController::class, 'reg']);
Route::post('/exit', [\App\Controllers\UserController::class, 'logout']);
Route::get('/home', [\App\Controllers\UserController::class, 'home']);
Route::post('/user/change-name', [\App\Controllers\UserController::class, 'changeName']);
Route::post('/user/change-password', [\App\Controllers\UserController::class, 'changePassword']);