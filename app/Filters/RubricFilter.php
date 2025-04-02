<?php

namespace App\Filters;

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