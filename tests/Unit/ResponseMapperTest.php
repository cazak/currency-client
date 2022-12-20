<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit;

use Cazak\CurrencyClient\Model\Currencies;
use Cazak\CurrencyClient\ResponseMapper;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ResponseMapperTest extends TestCase
{
    public function test_success(): void
    {
        $array = [
            '1inch' => '1inch Network',
            'aave' => 'Aave',
            'eur' => 'Euro',
            'rub' => 'Russian ruble',
        ];
        $response = new Response(200, ['Content-Type' => 'application/json'], json_encode($array));
        $mapper = new ResponseMapper();

        $currencies = $mapper->map($response, Currencies::class);

        self::assertInstanceOf(Currencies::class, $currencies);
        self::assertEquals($array, $currencies->getRawData());
    }

    public function test_error(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([]));
        $mapper = new ResponseMapper();

        self::expectExceptionMessage('Incorrect class');
        $mapper->map($response, self::class);
    }
}
