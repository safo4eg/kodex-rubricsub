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

}
