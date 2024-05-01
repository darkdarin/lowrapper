<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper;

/**
 * @api
 */
interface ConverterInterface
{
    /**
     * Convert formats
     * @param LowrapperParameters $parameters
     * @return string|null
     * @throws LowrapperException
     */
    public function convert(LowrapperParameters $parameters): ?string;
}
