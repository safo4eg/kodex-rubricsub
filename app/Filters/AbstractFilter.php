<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Class AbstractFilter
 *
 * Базовый абстрактный класс для реализации фильтров запросов.
 *
 * Данный класс предназначен для обработках входящих GET-параметров и применения их
 * к Eloquent-билдеру.
 *
 * Пример: строка запроса ?created_at=value&id=3 будут искать методы createdAt() и id()
 *
 * Методы должны принимать экземляр Illuminate\Database\Eloquent\Builder первым параметром
 * и mixed $value в которое попадет значение из строки запроса.
 *
 * Методы должны содержать атрибут #[FilterMethod] для исключение вызова пользователем
 * других нежелательных методов, а только строко определённых.
 */

abstract class AbstractFilter implements FilterInterface
{
    private array $queryParams = [];

    public function __construct(array $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    public function apply(Builder $builder): void
    {
        foreach ($this->queryParams as $name => $callback) {
            if(isset($this->queryParams[$name])) {
                call_user_func($callback, $builder, $this->queryParams[$name]);
            }
        }
    }

    public function getCallbacks(): array
    {
        $callbacks = [];
        $reflection = new \ReflectionClass(static::class);

        foreach($this->queryParams as $name => $value) {
            // меняем snake_case на camelCase
            $methodName = Str::camel($name);

            if($reflection->hasMethod($methodName)) {
                $method = $reflection->getMethod($methodName);
                $attributes = $method->getAttributes(FilterMethod::class);

                if(!empty($attributes)) {
                    $callbacks[$name] = [$this, $method->getName()];
                }
            }
        }

        return $callbacks;
    }

}




