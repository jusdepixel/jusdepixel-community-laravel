<?php

use App\Http\Controllers\ReactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\LogoutController;

Route::get('/', [HomeController::class, 'process'])->name('home@process');
Route::get('/me', [MeController::class, 'process'])->name('me@process');
Route::get('/auth', [AuthenticateController::class, 'process'])->name('auth@process');
Route::get('/logout', [LogoutController::class, 'process'])->name('logout@process');

Route::get('/react', [ReactController::class, 'process'])->name('react@process');
