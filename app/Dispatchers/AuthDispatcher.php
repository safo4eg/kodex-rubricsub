<?php

namespace App\Dispatchers;

use App\Dispatchers\Contracts\Dispatcher;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\App;

class AuthDispatcher extends Dispatcher
{
    /**
     * Регистрация пользователя
     * @return mixed
     * @throws \Exception
     */
    public function register():mixed
    {
        $callable = $this->getCallable('register');

        return ResponseHelper::getResponse(...App::call($callable));
    }
}