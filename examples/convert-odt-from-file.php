<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Example start

use DarkDarin\Lowrapper\Converter;
use DarkDarin\Lowrapper\Format\WebFormatEnum;
use DarkDarin\Lowrapper\LowrapperParameters;

$outputFile = __DIR__ . '/output/odt-to-html.html';

$converter = new Converter();
$parameters = (new LowrapperParameters(WebFormatEnum::HTML))
    ->setInputFile(__DIR__ . '/data/odt.odt');

$result = $converter->convert($parameters);

// Example finish


echo $result;
