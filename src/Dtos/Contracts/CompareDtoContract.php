<?php

namespace Iamtinhr\LaravelH5P\Dtos\Contracts;

/**
 * Interface CompareDtoContract
 * @package App\Dto\Contracts
 *
 * Class for compare separate Dtos that may contains different data,
 * but may be identify by the same content. For example just ID, or Name and ID.
 */
interface CompareDtoContract
{
    public function identifier(): array;
}
