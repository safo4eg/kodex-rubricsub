<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V2\DestroyUserRubricRequest;
use App\Http\Requests\Api\V2\StoreUserRubricRequest;
use App\Http\Resources\Api\V2\UserRubricResource;
use App\Models\Rubric;
use App\Models\User;
use App\Models\UserRubric;
use App\Services\Api\V2\UserRubricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class UserRubricController extends Controller
{
    private UserRubricService $userRubricService;

    public function __construct(UserRubricService $userRubricService)
    {
        $this->userRubricService = $userRubricService;
    }

    public function store(StoreUserRubricRequest $request, User $user, Rubric $rubric)
    {
        Gate::authorize('store', [UserRubric::class, $user, $rubric]);
        $userRubric = $this->userRubricService->store($user, $rubric);

        $responseData = [
            'success' => true,
            'data' => (new UserRubricResource($userRubric))->toArray($request),
            'message' => "Подписка успешно добавлена"
        ];

        return [$responseData, 201];
    }

    public function destroyWithUuid(User $user, string $uuid)
    {
        Gate::authorize('destroyWithUuid', [UserRubric::class, $user]);
        $this->userRubricService->destroyWithUuid($uuid);

        $responseData = [
            'success' => true,
            'data' => [],
            'message' => "Подписка успешно удалена"
        ];

        return [$responseData, 200];
    }
}
