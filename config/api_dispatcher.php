<?php
use \App\Http\Controllers\Api\V1;
use \App\Http\Controllers\Api\V2;

/**
 * Сопостовление версий с кнотроллерами
 * Если метод возвращает true он будет вызван, НО
 * - если метода нет в контроллере версии, вызовется метод предыдущей версии
 * - если метод = false, значит в текущей версии он не поддерживается
 */

return [
    \App\Dispatchers\UserRubricDispatcher::class => [
        'v1' => [
            'controller' => V1\UserRubricController::class,
            'unsupported_methods' => []
        ],
        'v2' => [
            'controller' => V2\UserRubricController::class,
            'unsupported_methods' => []
        ]
    ],

    \App\Dispatchers\UserDispatcher::class => [
        'v1' => [
            'controller' => V1\UserController::class,
            'unsupported_methods' => [],
        ],
        'v2' => [
            'controller' => null,
            'unsupported_methods' => [],
        ]
    ],

    \App\Dispatchers\AuthDispatcher::class => [
        'v1' => [
            'controller' => V1\AuthController::class,
            'unsupported_methods' => [],
        ],

        'v2' => [
            'controller' => null,
            'unsupported_methods' => [],
        ]
    ]
];