<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\Api\V1\RubricFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\IndexUserRubricRequest;
use App\Http\Resources\RubricResource;
use App\Http\Resources\UserRubricResource;
use App\Models\Rubric;
use App\Models\User;
use App\Models\UserRubric;
use App\Services\API\V1\UserRubricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserRubricController extends Controller
{
    private UserRubricService $userRubricService;

    public function __construct(UserRubricService $userRubricService)
    {
        $this->userRubricService = $userRubricService;
    }

    /**
     * Показать подписки пользователя
     * @param Request $request
     * @param User $user
     * @return void
     * @throws \Throwable
     */
    public function index(IndexUserRubricRequest $request, User $user, RubricFilter $filter)
    {
        $rubrics = $user->rubrics()
            ->filter($filter)
            ->get();

        $responseData = [
            'success' => true,
            'data' => RubricResource::collection($rubrics),
            'message' => ''
        ];

        return [$responseData, 200];
    }

    /**
     * Подписать пользователя на рубрику
     */
    public function store(Request $request, User $user, Rubric $rubric)
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

    public function destroy(Request $request, User $user, Rubric $rubric)
    {
        Gate::authorize('destroy', [UserRubric::class, $user, $rubric]);
        $this->userRubricService->destroy($user, $rubric);

        $responseData = [
            'success' => true,
            'data' => [],
            'message' => "Подписка успешно удалена"
        ];

        return [$responseData, 200];
    }

    /**
     * Удаление всех рубрик
     */
    public function destroyAll(Request $request, User $user)
    {
        Gate::authorize('destroyAll', [UserRubric::class, $user]);
        $this->userRubricService->destroyAll($user);

        $responseData = [
            'success' => true,
            'data' => [],
            'message' => "Подписки успешно удалены"
        ];

        return [$responseData, 200];
    }
}
