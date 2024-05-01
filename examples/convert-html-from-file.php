<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Example start

use DarkDarin\Lowrapper\Converter;
use DarkDarin\Lowrapper\Format\TextFormatEnum;
use DarkDarin\Lowrapper\LowrapperParameters;

//use DarkDarin\Lowrapper\DocumentTypeEnum;

$outputFile = __DIR__ . '/output/html-to-text.text';

$converter = new Converter();
$parameters = (new LowrapperParameters(TextFormatEnum::TEXT))
//    ->setDocumentType(DocumentTypeEnum::WRITER)
    ->setInputFile(__DIR__ . '/data/html.html')
//    ->addOutputFilter('Text (encoded)')
//    ->addOutputFilter('UTF8')
    ->setOutputFile($outputFile);

$converter->convert($parameters);

// Example finish


$result = file_get_contents($outputFile);
unlink($outputFile);
$html = '<pre>' . $result . '</pre>';
include __DIR__ . '/layout/layout.html';
