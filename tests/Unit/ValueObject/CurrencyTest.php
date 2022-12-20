<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit\ValueObject;

use Cazak\CurrencyClient\ValueObject\Currency;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class CurrencyTest extends TestCase
{
    public function test_success(): void
    {
        $validator = new Currency('rub');
        self::assertEquals('rub', $validator->getCurrency());
    }

    public function test_incorrect(): void
    {
        self::expectExceptionMessage('Incorrect currency');
        new Currency('hh');
    }
}
