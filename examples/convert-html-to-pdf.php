<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Logger.php';


// Example start

use DarkDarin\Lowrapper\Converter;
use DarkDarin\Lowrapper\DocumentTypeEnum;
use DarkDarin\Lowrapper\Format\TextFormatEnum;
use DarkDarin\Lowrapper\LowrapperParameters;

$source = file_get_contents(__DIR__ . '/data/html.html');

$converter = new Converter();
$converter->setLogger(new Logger());

$parameters = (new LowrapperParameters(TextFormatEnum::PDF))
    ->setDocumentType(DocumentTypeEnum::WRITER)
    ->setInputData($source)
    ->setOutputFile(__DIR__ . '/output/html-to-pdf.pdf');

$converter->convert($parameters);

// Example finish


$html = '<a href="output/html-to-pdf.pdf">html-to-pdf.pdf</a>';
include __DIR__ . '/layout/layout.html';
