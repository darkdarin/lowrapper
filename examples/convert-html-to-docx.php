<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Logger.php';


// Example start

use DarkDarin\Lowrapper\Converter;
use DarkDarin\Lowrapper\Format\TextFormatEnum;
use DarkDarin\Lowrapper\LowrapperParameters;

$source = file_get_contents(__DIR__ . '/data/html.html');

$converter = new Converter();
$converter->setLogger(new Logger());

$parameters = (new LowrapperParameters(TextFormatEnum::DOCX))
    ->setInputData($source)
    ->setOutputFile(__DIR__ . '/output/html-to-docx.docx');

$converter->convert($parameters);

// Example finish


$html = '<a href="output/html-to-docx.docx">html-to-docx.docx</a>';
include __DIR__ . '/layout/layout.html';
