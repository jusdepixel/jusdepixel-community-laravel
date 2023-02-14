<?php

use App\Http\Controllers\Web\AuthenticateController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LogoutController;
use App\Http\Controllers\Web\MeController;
use App\Http\Controllers\Web\ReactController;
use Illuminate\Support\Facades\Route;

Route::get('/{path?}', [ReactController::class, 'process'])->name('react@process');

Route::prefix('/blade');
Route::get('/home', [HomeController::class, 'process'])->name('home@process');
Route::get('/me', [MeController::class, 'process'])->name('me@process');
Route::get('/auth', [AuthenticateController::class, 'process'])->name('auth@process');
Route::get('/logout', [LogoutController::class, 'process'])->name('logout@process');
