<?php

declare(strict_types=1);

use Statista\Service\MultipleService;
use Statista\Service\PrintService;

require_once __DIR__.'/vendor/autoload.php';

error_reporting(E_ALL ^ E_DEPRECATED);

$multipleService = new MultipleService();

$printService = new PrintService($multipleService);

for ($i = 1; $i <= 100; $i++) {
    echo $printService->printNumberOrString($i).PHP_EOL;
}
