<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRubric extends Pivot
{
    const UPDATED_AT = false;
    public $incrementing = false;
    protected $table = 'user_rubric';
    protected $primaryKey = false;
    protected $guarded = [];

}
