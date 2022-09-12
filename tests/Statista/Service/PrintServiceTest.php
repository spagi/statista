<?php

namespace App\Tests\Statista\Service;

use Iterator;
use Statista\Service\MultipleService;
use Statista\Service\PrintService;
use PHPUnit\Framework\TestCase;

class PrintServiceTest extends TestCase
{

    /**
     * @dataProvider printDataProvider
     */
    public function testPrintNumberOrString(int $number, int|string $expected): void
    {
        $multipleService = new MultipleService();
        $printService = new PrintService($multipleService);

        $result = $printService->printNumberOrString($number);

        $this->assertSame($expected, $result);
    }

    public function printDataProvider(): Iterator
    {
        yield 'multiples of three ' => [
            33,
            'Fizz',
        ];

        yield 'multiples of five ' => [
            25,
            'Buzz',
        ];

        yield 'multiples of three and five ' => [
            15,
            'FizzBuzz',
        ];

        yield 'not multiples of three or five ' => [
            11,
            11,
        ];
    }
}
