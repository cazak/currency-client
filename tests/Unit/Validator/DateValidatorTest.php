<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit\Validator;

use Cazak\CurrencyClient\Validator\DateValidator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class DateValidatorTest extends TestCase
{
    public function test_success(): void
    {
        $validator = new DateValidator();

        self::assertTrue($validator->checkDate('2022-01-01'));
        self::assertTrue($validator->checkDate('latest'));
        self::assertTrue($validator->checkDate());
    }

    public function test_incorrect(): void
    {
        $validator = new DateValidator();

        self::assertFalse($validator->checkDate('error-date'));
    }

    public function test_incorrect_date(): void
    {
        $validator = new DateValidator();

        self::assertFalse($validator->checkDate('2022-14-14'));
    }
}
