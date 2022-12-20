<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit\Model;

use Cazak\CurrencyClient\Model\Currencies;
use Cazak\CurrencyClient\Model\Model;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class CurrenciesTest extends TestCase
{
    public function test_success(): void
    {
        $array = [
            '1inch' => '1inch Network',
            'aave' => 'Aave',
            'eur' => 'Euro',
            'rub' => 'Russian ruble',
        ];
        $currencies = new Currencies($array);

        self::assertInstanceOf(Model::class, $currencies);
        self::assertIsArray($currencies->getRawData());
        self::assertEquals($array, $currencies->getRawData());
    }
}
