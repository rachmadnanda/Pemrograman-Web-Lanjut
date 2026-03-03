<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\EventController;
Route::get('/event', [EventController::class, 'index']);

use App\Http\Controllers\GuestController;
Route::get('/guest', [GuestController::class, 'index']);

use App\Http\Controllers\UserController;
Route::get('/user', [UserController::class, 'index']);