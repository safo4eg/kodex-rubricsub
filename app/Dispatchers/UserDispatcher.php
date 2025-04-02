<?php

namespace App\Dispatchers;

use App\Dispatchers\Contracts\Dispatcher;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\App;

class UserDispatcher extends Dispatcher
{
    /**
     * Получение пользователей
     * @return mixed
     * @throws \Exception
     */
    public function index():mixed
    {
        $callable = $this->getCallable('index');

        return ResponseHelper::getResponse(...App::call($callable));
    }
}