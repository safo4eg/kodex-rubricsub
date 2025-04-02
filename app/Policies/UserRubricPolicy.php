<?php

namespace App\Policies;

use App\Models\Rubric;
use App\Models\User;
use App\Models\UserRubric;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserRubricPolicy
{
    public function store(
        User $authUser,
        User $forUser,
        Rubric $rubric
    ): Response
    {
        return $authUser->id === $forUser->id
            ? Response::allow()
            : Response::deny('Невозможно сделать подписку за другого пользователя.');
    }

    public function destroy(
        User $authUser,
        User $forUser,
        Rubric $rubric
    ): Response
    {
        return $authUser->id === $forUser->id
            ? Response::allow()
            : Response::deny('Невозможно удалить подписку другому пользователю');
    }

    public function destroyAll(
        User $authUser,
        User $forUser,
    ): Response
    {
        return $authUser->id === $forUser->id
            ? Response::allow()
            : Response::deny('Невозможно удалить подписки другому пользователю');
    }
}

