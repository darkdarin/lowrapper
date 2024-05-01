<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper\Format;

use DarkDarin\Lowrapper\DocumentTypeEnum;

/**
 * @api
 */
enum TextFormatEnum: string implements FormatInterface
{
    case BIB = 'bib';
    case DOC = 'doc';
    case DOC6 = 'doc6';
    case DOC95 = 'doc95';
    case DOCBOOK = 'docbook';
    case DOCX = 'docx';
    case DOCX7 = 'docx7';
    case FODT = 'fodt';
    case HTML = 'html';
    case LATEX = 'latex';
    case MEDIAWIKI = 'mediawiki';
    case ODT = 'odt';
    case OOXML = 'ooxml';
    case OTT = 'ott';
    case PDB = 'pdb';
    case PDF = 'pdf';
    case PSW = 'psw';
    case RTF = 'rtf';
    case SDW = 'sdw';
    case SDW4 = 'sdw4';
    case SDW3 = 'sdw3';
    case STW = 'stw';
    case SXW = 'sxw';
    case TEXT = 'text';
    case TXT = 'txt';
    case UOT = 'uot';
    case VOR = 'vor';
    case VOR4 = 'vor4';
    case VOR3 = 'vor3';
    case WPS = 'wps';
    case XHTML = 'xhtml';

    public function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::WRITER;
    }

    public function getFormat(): string
    {
        return $this->value;
    }
}
