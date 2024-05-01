<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper\Format;

use DarkDarin\Lowrapper\DocumentTypeEnum;

/**
 * @api
 */
enum WebFormatEnum: string implements FormatInterface
{
    case ETEXT = 'etext';
    case HTML10 = 'html10';
    case HTML = 'html';
    case MEDIAWIKI = 'mediawiki';
    case PDF = 'pdf';
    case SDW3 = 'sdw3';
    case SDW4 = 'sdw4';
    case SDW = 'sdw';
    case TXT = 'txt';
    case TEXT10 = 'text10';
    case TEXT = 'text';
    case VOR4 = 'vor4';
    case VOR = 'vor';

    public function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::WEB;
    }

    public function getFormat(): string
    {
        return $this->value;
    }
}
