<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Subscription extends Pivot
{
    const UPDATED_AT = false;
    public $incrementing = false;
    protected $table = 'subscriptions';
    protected $primaryKey = false;
    protected $guarded = [];

}
