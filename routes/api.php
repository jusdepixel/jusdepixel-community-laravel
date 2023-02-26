<?php

use Illuminate\Support\Facades\Route;

Route::get('/init/url',
    \App\Http\Controllers\Api\Instagram\Init\AuthorizeUrlController::class)
    ->name('init@url');

Route::prefix('/auth')->group(static function(): void {

    Route::get('/code/{code}',
        \App\Http\Controllers\Api\Instagram\Auth\CodeController::class)
        ->name('auth@code');

    Route::get('/login/{code}',
        \App\Http\Controllers\Api\Instagram\Auth\LoginController::class)
        ->name('auth@login');

    Route::get('/profile',
        \App\Http\Controllers\Api\Instagram\Auth\ProfileController::class)
        ->name('auth@profile');

    Route::post('/logout',
        \App\Http\Controllers\Api\Instagram\Auth\LogoutController::class)
        ->name('auth@logout');
});

Route::prefix('/me')
    ->middleware(\App\Http\Middleware\Instagram::class)
    ->group(static function(): void {

        Route::get('/profile',
            \App\Http\Controllers\Api\Instagram\Me\ProfileController::class)
            ->name('me@profile');

        Route::get('/posts',
            \App\Http\Controllers\Api\Instagram\Me\PostsController::class)
            ->name('me@posts');

        Route::get('/posts/{id}',
            \App\Http\Controllers\Api\Instagram\Me\PostController::class)
            ->name('me@post');

        Route::post('/posts/{instagramId}',
            \App\Http\Controllers\Api\Instagram\Me\PostCreateController::class)
            ->name('post@create');

        Route::delete('/posts/{post}',
            \App\Http\Controllers\Api\Instagram\Me\PostDeleteController::class)
            ->name('post@delete');
});

Route::prefix('/posts')->group(static function(): void {

    Route::get('/',
        \App\Http\Controllers\Api\Instagram\Posts\AllController::class, 'all')
        ->name('post@all');

    Route::get('/{id}',
        \App\Http\Controllers\Api\Instagram\Posts\OneController::class)
        ->name('post@one');
});

Route::prefix('/users')->group(static function(): void {

    Route::get('/', \App\Http\Controllers\Api\Instagram\Users\AllController::class)
        ->name('user@all');

    Route::get('/{user}', \App\Http\Controllers\Api\Instagram\Users\OneController::class)
        ->name('user@one');

//    Route::post('/{user}/posts/{id}/create',
// \App\Http\Controllers\Api\User\CreateController::class)
//        ->name('user@create');
//
//    Route::delete('/{user}/posts/{id}/delete',
// \App\Http\Controllers\Api\User\DeleteController::class)
//        ->name('user@delete');
});
//
//Route::prefix('/refresh')->group(static function(): void {
//
//    Route::get('/user',
// \App\Http\Controllers\Api\Refresh\UserController::class)
//        ->name('refresh@user');
//
//    Route::get('/post',
// \App\Http\Controllers\Api\Refresh\PostController::class)
//        ->name('refresh@post');
//});
