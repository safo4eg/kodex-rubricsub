<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\Api\V1\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\IndexUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index(IndexUserRequest $request, UserFilter $filter)
    {
        $users = User::filter($filter)->get();

        $responseData = [
            'success' => true,
            'data' => UserResource::collection($users),
            'message' => ''
        ];

        return [$responseData, 200];
    }
}
