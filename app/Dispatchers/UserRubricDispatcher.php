<?php

namespace App\Dispatchers;

use App\Dispatchers\Contracts\Dispatcher;
use App\Models\Rubric;
use App\Models\User;
use Illuminate\Http\Request;

class UserRubricDispatcher extends Dispatcher
{

    public function store(Request $request, User $user, Rubric $rubric): mixed
    {
        return $this->run('store', $request, $user, $rubric);
    }
}