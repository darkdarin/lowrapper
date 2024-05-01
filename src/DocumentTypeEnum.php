<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper;

enum DocumentTypeEnum: string
{
    case WRITER = 'writer';
    case CALC = 'calc';
    case DRAW = 'draw';
    case IMPRESS = 'impress';
    case BASE = 'base';
    case MATH = 'math';
    case GLOB = 'global';
    case WEB = 'web';
}
