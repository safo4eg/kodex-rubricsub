<?php

namespace App\Dispatchers;

use App\Dispatchers\Contracts\Dispatcher;
use App\Helpers\ResponseHelper;
use App\Models\Rubric;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserRubricDispatcher extends Dispatcher
{
    /**
     * Отображение подписок пользователя
     * @param Request $request
     * @param User $user
     * @return mixed
     * @throws \Exception
     */
    public function index(User $user): mixed
    {
        $callable = $this->getCallable('index');

        return ResponseHelper::getResponse(...App::call($callable, ['user' => $user]));
    }

    /**
     * Вызов создания подписки
     * @param Request $request
     * @param User $user
     * @param Rubric $rubric
     * @return mixed
     * @throws \Exception
     */
    public function store(User $user, Rubric $rubric): mixed
    {
        $callable =  $this->getCallable('store');

        return ResponseHelper::getResponse(...App::call($callable, [
            'user' => $user,
            'rubric' => $rubric
        ]));
    }

    /**
     * Удаление подписки
     * @param Request $request
     * @param User $user
     * @param Rubric $rubric
     * @return mixed
     * @throws \Exception
     */
    public function destroy(User $user, Rubric $rubric): mixed
    {
        $callable =  $this->getCallable('destroy');

        return ResponseHelper::getResponse(...App::call($callable, [
            'user' => $user,
            'rubric' => $rubric
        ]));
    }

    /**
     * Удаление всех подписок пользователя
     * @param Request $request
     * @param User $user
     * @return mixed
     * @throws \Exception
     */
    public function destroyAll(User $user): mixed
    {
        $callable =  $this->getCallable('destroyAll');

        return ResponseHelper::getResponse(...App::call($callable, ['user' => $user]));
    }
}