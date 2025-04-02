<?php

namespace App\Services\API\V1;
use App\Models\Rubric;
use App\Models\User;
use App\Models\UserRubric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRubricService
{
    public function store(User $user, Rubric $rubric): UserRubric
    {
        DB::beginTransaction();
        try {
            $userRubric = UserRubric::createAndSave(
                userId: $user->id,
                rubricId: $rubric->id
            );
            DB::commit();

            return $userRubric;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function destroy(User $user, Rubric $rubric): void
    {
        DB::beginTransaction();
        try {
            UserRubric::where('user_id', $user->id)
                ->where('rubric_id', $rubric->id)
                ->delete();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function destroyAll(User $user): void
    {
        DB::beginTransaction();
        try {
            $user->rubrics()->detach();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}