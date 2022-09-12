<?php

declare(strict_types=1);

namespace Statista\Service;

class MultipleService
{

    public function multipleByThree(int $toCheck): bool
    {
        return $toCheck % 3 === 0;
    }

    public function multipleByFive(int $toCheck): bool
    {
        return $toCheck % 5 === 0;
    }
}