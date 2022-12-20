<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit\Model;

use Cazak\CurrencyClient\Model\Model;
use Cazak\CurrencyClient\Model\RateByCurrency;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RateByCurrencyTest extends TestCase
{
    public function test_success(): void
    {
        $array = [
            'date' => '2022-12-13',
            'jpy' => 143.78,
        ];
        $rateByCurrency = new RateByCurrency($array);

        self::assertInstanceOf(Model::class, $rateByCurrency);
        self::assertIsArray($rateByCurrency->getRawData());
        self::assertEquals($array, $rateByCurrency->getRawData());
        self::assertEquals('2022-12-13', $rateByCurrency->getDate());
        self::assertEquals('jpy', $rateByCurrency->getCurrency());
        self::assertEquals(143.78, $rateByCurrency->getPrice());
    }
}
