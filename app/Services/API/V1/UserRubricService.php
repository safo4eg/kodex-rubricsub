<?php

namespace App\Services\API\V1;
use App\Models\Rubric;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRubricService
{
    public function store(User $user, Rubric $rubric): void
    {
        DB::beginTransaction();
        try {

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}