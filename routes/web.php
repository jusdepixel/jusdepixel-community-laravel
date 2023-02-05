<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Logout;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home@index');
Route::get('/logout', [Logout::class, 'process'])->name('logout@process');
