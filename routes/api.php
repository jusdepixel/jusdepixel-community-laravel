<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\InitializeController;
use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\LogoutController;

Route::prefix('/api');

Route::get('/home', HomeController::class)->name('home');
Route::get('/me',MeController::class)->name('me');
Route::get('/logout', LogoutController::class)->name('logout');
Route::get('/authenticate', AuthenticateController::class)->name('authenticate');
Route::get('/initialize/profile', [InitializeController::class, 'profile'])->name('initialize@profile');
Route::get('/initialize/url', [InitializeController::class, 'url'])->name('initialize@url');
Route::get('/post/create/{id}', [PostController::class, 'create'])->name('post@create');
Route::get('/post/delete/{id}', [PostController::class, 'delete'])->name('post@delete');
