<?php

namespace App\Dispatchers;

use App\Dispatchers\Contracts\Dispatcher;
use App\Models\Rubric;
use App\Models\User;
use Illuminate\Http\Request;

class UserRubricDispatcher extends Dispatcher
{

    /**
     * Вызов создания подписки
     * @param Request $request
     * @param User $user
     * @param Rubric $rubric
     * @return mixed
     * @throws \Exception
     */
    public function store(Request $request, User $user, Rubric $rubric): mixed
    {
        return $this->run('store', $request, $user, $rubric);
    }

    public function destroy(Request $request, User $user, Rubric $rubric): mixed
    {
        return $this->run('destroy', $request, $user, $rubric);
    }
}