<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
Route::delete('delete/{user}', [App\Http\Controllers\Api\UserController::class, 'destroy']);
Route::post('login', [App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Api\UserController::class, 'logout']);
Route::put('edit/{id}', [App\Http\Controllers\Api\UserController::class, 'edit']);