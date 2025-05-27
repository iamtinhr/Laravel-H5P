<?php

namespace Iamtinhr\LaravelH5P\Dtos;

use Iamtinhr\LaravelH5P\Dtos\Contracts\DtoContract;
use Illuminate\Support\Collection;

class CriteriaDto implements DtoContract
{
    private Collection $criteria;

    /**
     * CriteriaDto constructor.
     * @param Collection $criteria
     */
    public function __construct(Collection $criteria)
    {
        $this->criteria = $criteria;
    }

    public function toArray(): array
    {
        return $this->get()->toArray();
    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->criteria;
    }
}
