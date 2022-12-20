<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit;

use Cazak\CurrencyClient\Url;
use Cazak\CurrencyClient\ValueObject\Currency;
use Cazak\CurrencyClient\ValueObject\Date;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class UrlTest extends TestCase
{
    public function test_endpoint_success(): void
    {
        $url = new Url();
        $currenciesUrl = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies.json';
        $rateByCurrency = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/eur.json';
        $ratesByCurrency = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/2013-12-12/currencies/eur/jpy.json';

        self::assertEquals($currenciesUrl, $url->getEndpoint(new Date()));
        self::assertEquals($rateByCurrency, $url->getEndpoint(new Date(), new Currency('eur')));
        self::assertEquals($ratesByCurrency, $url->getEndpoint(new Date('2013-12-12'), new Currency('eur'), new Currency('jpy')));
    }
}
