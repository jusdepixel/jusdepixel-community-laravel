<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ReactController;

Route::get('/{path?}', [ReactController::class, 'process'])->name('react@process');
