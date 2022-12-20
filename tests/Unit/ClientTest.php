<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit;

use Cazak\CurrencyClient\Client as ApiClient;
use Cazak\CurrencyClient\Tests\Support\DummyStorage;
use Cazak\CurrencyClient\ValueObject\Currency;
use Cazak\CurrencyClient\ValueObject\Date;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ClientTest extends TestCase
{
    private MockHandler $mock;
    private ApiClient $client;
    private DummyStorage $storage;

    protected function setUp(): void
    {
        $this->storage = new DummyStorage();
        $this->mock = new MockHandler();
        $this->client = new ApiClient(
            new Client(['handler' => new HandlerStack($this->mock)]),
            $this->storage,
            new \GuzzleHttp\Psr7\HttpFactory(),
        );
    }

    public function test_currencies_success(): void
    {
        $array = [
            '1inch' => '1inch Network',
            'aave' => 'Aave',
            'eur' => 'Euro',
            'rub' => 'Russian ruble',
        ];
        $this->appendQueue($array);

        $data = $this->client->currencies();

        self::assertIsArray($data);
        self::assertArrayHasKey('1inch', $data);
        self::assertArrayHasKey('aave', $data);
        self::assertArrayHasKey('eur', $data);
        self::assertArrayHasKey('rub', $data);

        self::assertEquals($array, $this->storage->getItems());
    }

    public function test_get_rate_by_currency_success(): void
    {
        $array = [
            'date' => '2022-12-13',
            'jpy' => 143.788552,
        ];

        $this->appendQueue($array);

        $data = $this->client->getRateByCurrency(new Currency('eur'), new Currency('jpy'), new Date('2022-12-13'));

        self::assertIsArray($data);
        self::assertEquals('2022-12-13', $data['date']);
        self::assertEquals(143.788552, $data['jpy']);

        self::assertEquals($array, $this->storage->getItems());
    }

    public function test_get_rate_by_currency_error_date(): void
    {
        $array = [
            'date' => '2022-12-13',
            'jpy' => 143.788552,
        ];

        $this->appendQueue($array);

        $this->expectExceptionMessage('Incorrect date');
        $this->client->getRateByCurrency(new Currency('eur'), new Currency('jpy'), new Date('error-date'));
    }

    public function test_get_rate_by_currency_error_currency(): void
    {
        $array = [
            'date' => '2022-12-13',
            'jpy' => 143.788552,
        ];

        $this->appendQueue($array);

        self::expectExceptionMessage('Incorrect currency');
        $this->client->getRateByCurrency(new Currency('eur'), new Currency('jpyy'), new Date('2022-12-13'));
    }

    public function test_get_rates_by_base_currency_success(): void
    {
        $array = [
            'date' => '2022-12-13',
            'eur' => [
                '1inch' => 2.438527,
                'aave' => 0.017691,
                'ada' => 3.42364,
                'aed' => 3.860913,
            ],
        ];

        $this->appendQueue($array);

        $data = $this->client->getRatesByBaseCurrency(new Currency('eur'), new Date('2022-12-13'));

        self::assertIsArray($data);
        self::assertEquals('2022-12-13', $data['date']);
        self::assertEquals(2.438527, $data['eur']['1inch']);
        self::assertEquals(0.017691, $data['eur']['aave']);
        self::assertEquals(3.42364, $data['eur']['ada']);
        self::assertEquals(3.860913, $data['eur']['aed']);

        self::assertEquals($array, $this->storage->getItems());
    }

    private function appendQueue(array $data): void
    {
        $this->mock->append(new Response(200, ['Content-Type' => 'application/json'], json_encode($data)));
    }
}
