<?php

use App\Router\Route;

Route::get('/', [\App\Controllers\IndexController::class, 'index'])->setName('index');
Route::get('/login', [\App\Controllers\AuthController::class, 'login'])->setName('login');
Route::post('/login', [\App\Controllers\AuthController::class, 'auth'])->setName('login.auth');
Route::get('/registration', [\App\Controllers\AuthController::class, 'registration'])->setName('registration');
Route::post('/registration', [\App\Controllers\AuthController::class, 'reg'])->setName('reg');
Route::post('/exit', [\App\Controllers\UserController::class, 'logout'])->setName('logout');
Route::get('/home', [\App\Controllers\UserController::class, 'home'])->setName('home');
Route::post('/user/change-name', [\App\Controllers\UserController::class, 'changeName'])->setName('changeName');
Route::post('/user/change-password', [\App\Controllers\UserController::class, 'changePassword'])->setName('changePassword');