<?php

namespace App\Services\Api\V2;
use App\Models\Rubric;
use App\Models\User;
use App\Models\UserRubric;
use Illuminate\Support\Facades\DB;

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
}