<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper\Format;

use DarkDarin\Lowrapper\DocumentTypeEnum;

/**
 * @api
 */
enum GraphicsFormatEnum: string implements FormatInterface
{
    case BMP = 'bmp';
    case EMF = 'emf';
    case EPS = 'eps';
    case FODG = 'fodg';
    case GIF = 'gif';
    case HTML = 'html';
    case JPG = 'jpg';
    case MET = 'met';
    case ODD = 'odd';
    case OTG = 'otg';
    case PBM = 'pbm';
    case PCT = 'pct';
    case PDF = 'pdf';
    case PGM = 'pgm';
    case PNG = 'png';
    case PPM = 'ppm';
    case RAS = 'ras';
    case STD = 'std';
    case SVG = 'svg';
    case SVM = 'svm';
    case SWF = 'swf';
    case SXD = 'sxd';
    case SXD3 = 'sxd3';
    case SXD5 = 'sxd5';
    case SXW = 'sxw';
    case TIFF = 'tiff';
    case VOR = 'vor';
    case VOR3 = 'vor3';
    case WMF = 'wmf';
    case XHTML = 'xhtml';
    case XPM = 'xpm';

    public function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::DRAW;
    }

    public function getFormat(): string
    {
        return $this->value;
    }
}
