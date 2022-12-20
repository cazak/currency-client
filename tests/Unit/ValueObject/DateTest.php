<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit\ValueObject;

use Cazak\CurrencyClient\ValueObject\Date;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class DateTest extends TestCase
{
    public function test_success(): void
    {
        self::assertEquals('2022-01-01', (new Date('2022-01-01'))->getDate());
        self::assertEquals('latest', (new Date('latest'))->getDate());
        self::assertEquals('latest', (new Date())->getDate());
    }

    public function test_incorrect(): void
    {
        self::expectExceptionMessage('Incorrect date');
        new Date('error-date');
    }

    public function test_incorrect_date(): void
    {
        self::expectExceptionMessage('Incorrect date');
        new Date('2022-14-14');
    }
}
