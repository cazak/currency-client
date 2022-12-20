<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit\Model;

use Cazak\CurrencyClient\Model\Model;
use Cazak\CurrencyClient\Model\RatesByCurrency;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RatesByCurrencyTest extends TestCase
{
    public function test_success(): void
    {
        $array = [
            'date' => '2022-12-13',
            'eur' => $rates = [
                '1inch' => 2.438527,
                'aave' => 0.017691,
                'ada' => 3.42364,
                'aed' => 3.860913,
            ],
        ];
        $ratesByCurrency = new RatesByCurrency($array);

        self::assertInstanceOf(Model::class, $ratesByCurrency);
        self::assertIsArray($ratesByCurrency->getRawData());
        self::assertEquals($array, $ratesByCurrency->getRawData());
        self::assertEquals($rates, $ratesByCurrency->getCurrencyRates());
        self::assertEquals('2022-12-13', $ratesByCurrency->getDate());
        self::assertEquals('eur', $ratesByCurrency->getCurrency());
    }
}
