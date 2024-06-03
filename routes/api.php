<?php

use App\Http\Controllers\CurrentRateController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(PostController::class)->prefix('posts')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{post}', 'show');
        Route::patch('/{post}', 'update');
        Route::delete('/{post}', 'destroy');
        Route::get('/get-by-user', 'getByUser');
    });
});

Route::get('/rate', CurrentRateController::class);
