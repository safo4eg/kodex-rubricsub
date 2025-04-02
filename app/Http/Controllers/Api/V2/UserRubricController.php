<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\Rubric;
use App\Models\User;
use App\Services\API\V1\UserRubricService;
use Illuminate\Http\Request;

class UserRubricController extends Controller
{
    private UserRubricService $userRubricService;

    public function __construct(UserRubricService $userRubricService)
    {
        $this->userRubricService = $userRubricService;
    }
}
