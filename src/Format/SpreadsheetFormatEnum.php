<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper\Format;

use DarkDarin\Lowrapper\DocumentTypeEnum;

/**
 * @api
 */
enum SpreadsheetFormatEnum: string implements FormatInterface
{
    case CSV = 'csv';
    case DBF = 'dbf';
    case DIF = 'dif';
    case FODS = 'fods';
    case HTML = 'html';
    case ODS = 'ods';
    case OOXML = 'ooxml';
    case OTS = 'ots';
    case PDF = 'pdf';
    case PXL = 'pxl';
    case SDC = 'sdc';
    case SDC4 = 'sdc4';
    case SDC3 = 'sdc3';
    case SLK = 'slk';
    case STC = 'stc';
    case SXC = 'sxc';
    case UOS = 'uos';
    case VOR3 = 'vor3';
    case VOR4 = 'vor4';
    case VOR = 'vor';
    case XHTML = 'xhtml';
    case XLS = 'xls';
    case XLS5 = 'xls5';
    case XLS95 = 'xls95';
    case XLT = 'xlt';
    case XLT5 = 'xlt5';
    case XLT95 = 'xlt95';
    case XLSX = 'xlsx';

    public function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::CALC;
    }

    public function getFormat(): string
    {
        return $this->value;
    }
}
