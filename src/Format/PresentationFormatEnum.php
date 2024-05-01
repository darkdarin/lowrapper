<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper\Format;

use DarkDarin\Lowrapper\DocumentTypeEnum;

/**
 * @api
 */
enum PresentationFormatEnum: string implements FormatInterface
{
    case BMP = 'bmp';
    case EMF = 'emf';
    case EPS = 'eps';
    case FODP = 'fodp';
    case GIF = 'gif';
    case HTML = 'html';
    case JPG = 'jpg';
    case MET = 'met';
    case ODG = 'odg';
    case ODP = 'odp';
    case OTP = 'otp';
    case PBM = 'pbm';
    case PCT = 'pct';
    case PDF = 'pdf';
    case PGM = 'pgm';
    case PNG = 'png';
    case POTM = 'potm';
    case POT = 'pot';
    case PPM = 'ppm';
    case PPTX = 'pptx';
    case PPS = 'pps';
    case PPT = 'ppt';
    case PWP = 'pwp';
    case RAS = 'ras';
    case SDA = 'sda';
    case SDD = 'sdd';
    case SDD3 = 'sdd3';
    case SDD4 = 'sdd4';
    case SXD = 'sxd';
    case STI = 'sti';
    case SVG = 'svg';
    case SVM = 'svm';
    case SWF = 'swf';
    case SXI = 'sxi';
    case TIFF = 'tiff';
    case UOP = 'uop';
    case VOR = 'vor';
    case VOR3 = 'vor3';
    case VOR4 = 'vor4';
    case VOR5 = 'vor5';
    case WMF = 'wmf';
    case XPM = 'xpm';

    public function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::IMPRESS;
    }

    public function getFormat(): string
    {
        return $this->value;
    }
}
