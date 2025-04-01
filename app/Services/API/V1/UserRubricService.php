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
            return UserRubric::createAndSave(
                userId: $user->id,
                rubricId: $rubric->id
            );
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}