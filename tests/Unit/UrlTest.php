<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit;

use Cazak\CurrencyClient\Url;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class UrlTest extends TestCase
{
    private const VERSION = 1;

    public function test_endpoint_success(): void
    {
        $url = new Url(self::VERSION);
        $expectUrl = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/';

        self::assertEquals($expectUrl, $url->getEndpoint());
    }

    public function test_endpoint_error(): void
    {
        $url = new Url(self::VERSION);
        $errorUrl = 'error';

        self::assertNotEquals($errorUrl, $url->getEndpoint());
    }

    public function test_default_url_success(): void
    {
        $url = new Url(self::VERSION);
        $expectUrl = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/';
        $urlWithDate = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/2022-13-12/';

        self::assertEquals($expectUrl, $url->getDefaultUrl());
        self::assertEquals($urlWithDate, $url->getDefaultUrl('2022-13-12'));
    }

    public function test_default_endpoint_error(): void
    {
        $url = new Url(self::VERSION);
        $errorUrl = 'error';
        $errorUrlWithDate = '2022-13-12';

        self::assertNotEquals($errorUrl, $url->getDefaultUrl());
        self::assertNotEquals($errorUrlWithDate, $url->getDefaultUrl($errorUrlWithDate));
    }
}
