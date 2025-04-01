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

//        Route::delete('/users/{user}/rubrics/{rubric}', ApiVersionHelper::versions([
//            'v1' => [\App\Http\Controllers\API\V2\UserRubricController::class, 'destroy'],
//            'v2' => [] // тут класс который отвечает за обработку во второй версии
//        ]));
//
//        Route::delete('/users/{user}/rubrics', ApiVersionHelper::versions([
//            'v1' => [\App\Http\Controllers\API\V2\UserRubricController::class, 'destroyAll'],
//            'v2' => [] // тут класс который отвечает за обработку во второй версии
//        ]));
    });
});
