<?php

namespace App\Services\API\V1;
use App\Models\Rubric;
use App\Models\User;
use App\Models\UserRubric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRubricService
{
    public function store(User $user, Rubric $rubric): void
    {
        DB::beginTransaction();
        try {
            $user->rubrics()->attach($rubric->id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}