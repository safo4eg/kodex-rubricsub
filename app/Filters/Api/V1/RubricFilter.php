<?php

namespace App\Filters\Api\V1;

use App\Filters\AbstractFilter;
use App\Filters\FilterMethod;
use Illuminate\Database\Eloquent\Builder;

class RubricFilter extends AbstractFilter
{
    #[FilterMethod]
    public function limit(Builder $builder, $value)
    {
        $builder->limit($value);
    }

    #[FilterMethod]
    public function offset(Builder $builder, $value)
    {
        $builder->offset($value);
    }
}