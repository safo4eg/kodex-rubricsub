<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
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
//        $this->authorizeResource
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
    public function destroyAll(string $id)
    {
        //
    }
}
