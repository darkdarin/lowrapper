<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Logger.php';


// Example start

use DarkDarin\Lowrapper\Converter;
use DarkDarin\Lowrapper\Format\WebFormatEnum;
use DarkDarin\Lowrapper\LowrapperParameters;

$converter = new Converter();
$converter->setLogger(new Logger());

$parameters = (new LowrapperParameters(WebFormatEnum::HTML))
    ->setInputFile(__DIR__ . '/data/docx.docx')
    ->setOutputFile(__DIR__ . '/output/docx-to-html.html');

$converter->convert($parameters);

// Example finish


include __DIR__ . '/output/docx-to-html.html';
