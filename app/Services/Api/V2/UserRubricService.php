<?php

namespace App\Services\Api\V2;
use App\Models\Rubric;
use App\Models\User;
use App\Models\UserRubric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserRubricService
{
    public function store(User $user, Rubric $rubric): UserRubric
    {
        DB::beginTransaction();
        try {
            $userRubric = UserRubric::createAndSave(
                userId: $user->id,
                rubricId: $rubric->id,
                uuid: Str::uuid()
            );
            DB::commit();

            return $userRubric;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function destroyWithUuid(string $uuid): void
    {
        DB::beginTransaction();
        try {
            UserRubric::where('uuid', $uuid)->delete();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}