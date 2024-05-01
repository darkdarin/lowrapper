<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper;

use DarkDarin\Lowrapper\Format\FormatInterface;
use DarkDarin\Lowrapper\Format\TextFormatEnum;

class OutputFilters
{
    /**
     * More filters: https://wiki.openoffice.org/wiki/Framework/Article/Filter/FilterList_OOo_3_0
     */
    public const TEXT_ENCODED = 'Text (encoded)';
    public const UTF8 = 'UTF8';

    /**
     * Default filters for output formats
     * @param FormatInterface|null $outputFormat
     * @return array<string>
     */
    public static function getDefault(?FormatInterface $outputFormat): array
    {
        return match ($outputFormat) {
            TextFormatEnum::TEXT => [
                static::TEXT_ENCODED,
                static::UTF8,
            ],
            default => [],
        };
    }
}
