<?php

use App\Http\Controllers\API\V1\AuthController;
use Illuminate\Support\Facades\Route;
use \App\Dispatchers\UserRubricDispatcher;

Route::name('auth.')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register');
});

Route::middleware('auth:api')->group(function () {
    Route::name('users.rubrics.')->group(function () {

        Route::post('/users/{user}/rubrics/{rubric}', [UserRubricDispatcher::class, 'store']);
        Route::delete('/users/{user}/rubrics/{rubric}', [UserRubricDispatcher::class, 'destroy']);
        Route::delete('/users/{user}/rubrics', [UserRubricDispatcher::class, 'destroyAll']);
        Route::get('/users/{user}/rubrics', [UserRubricDispatcher::class, 'index']);
    });
});
