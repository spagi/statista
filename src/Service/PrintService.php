<?php

declare(strict_types=1);

namespace Statista\Service;

class PrintService
{
    private MultipleService $multipleService;

    public function __construct(MultipleService $multipleService)
    {
        $this->multipleService = $multipleService;
    }

    public function printNumberOrString(int $toCheck): string|int
    {
        $multipleByFive = $this->multipleService->multipleByThree($toCheck);
        $multipleByThree = $this->multipleService->multipleByFive($toCheck);

        if (!$multipleByFive && !$multipleByThree) {
            return $toCheck;
        }

        $return = '';

        if ($multipleByFive) {
            $return .= 'Fizz';
        }

        if ($multipleByThree) {
            $return .= 'Buzz';
        }

        return $return;
    }
}