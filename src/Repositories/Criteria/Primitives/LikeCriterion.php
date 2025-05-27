<?php


namespace Iamtinhr\LaravelH5P\Repositories\Criteria\Primitives;

use Iamtinhr\LaravelH5P\Repositories\Criteria\Criterion;
use Illuminate\Database\Eloquent\Builder;

class LikeCriterion extends Criterion
{
    public function apply(Builder $query): Builder
    {
        return $query->where($this->key, 'LIKE', "%$this->value%");
    }
}
