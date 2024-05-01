<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper\Format;

use DarkDarin\Lowrapper\DocumentTypeEnum;

/**
 * @api
 */
interface FormatInterface
{
    public function getDocumentType(): DocumentTypeEnum;

    public function getFormat(): string;
}
