<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRubric extends Pivot
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'user_rubric';
    protected $primaryKey = false;
    protected $guarded = [];

    public static function createAndSave(
        int $userId,
        int $rubricId,
        ?string $uuid = null
    ): static
    {
        $instance = new static();
        $instance->user_id = $userId;
        $instance->rubric_id = $rubricId;
        $instance->created_at = now();
        $instance->uuid = $uuid;
        $instance->save();
        return $instance;
    }
}
