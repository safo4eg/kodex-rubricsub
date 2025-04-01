<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Rubric;
use App\Models\User;
use App\Services\API\V1\UserRubricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserRubricController extends Controller
{
    private UserRubricService $userRubricService;

    public function __construct(UserRubricService $userRubricService)
    {
        $this->userRubricService = $userRubricService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Подписать пользователя на рубрику
     */
    public function store(Request $request, User $user, Rubric $rubric)
    {
        $this->userRubricService->store($user, $rubric);
        return response()->json(['test' => 'da'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Удаление всех рубрик
     */
    public function destroyAll(string $id)
    {
        //
    }
}
