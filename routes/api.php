<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserRubricController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::name('auth.')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register');
});

Route::middleware('auth:api')->group(function () {
    Route::name('users.rubrics.')->group(function () {
        Route::post('/users/{user}/rubrics/{rubric}', [UserRubricController::class, 'store']);
        Route::delete('/users/{user}/rubrics/{rubric}', [UserRubricController::class, 'destroy']);
        Route::delete('/users/{user}/rubrics', [UserRubricController::class, 'destroyAll']);
    });
});