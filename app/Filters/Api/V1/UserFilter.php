<?php

namespace App\Filters\Api\V1;

use App\Filters\AbstractFilter;
use App\Filters\FilterMethod;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    /**
     * Фильтрация по наличию рубрики
     * @param Builder $builder
     * @param $value
     * @return void
     */
    #[FilterMethod]
    public function rubricId(Builder $builder, $value)
    {
        $builder->whereHas('rubrics', function ($query) use ($value) {
            $query->where('id', $value);
        });
    }

    /**
     * Фильтрация по ид пользователя
     * @param Builder $builder
     * @param $value
     * @return void
     */
    #[FilterMethod]
    public function userId(Builder $builder, $value)
    {
        $builder->where('id', $value);
    }

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