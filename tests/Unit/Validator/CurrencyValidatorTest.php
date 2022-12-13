<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Unit\Validator;

use Cazak\CurrencyClient\Validator\CurrencyValidator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class CurrencyValidatorTest extends TestCase
{
    public function test_success(): void
    {
        $validator = new CurrencyValidator();
        $this->assertTrue($validator->checkCurrency('rub'));
    }

    public function test_incorrect(): void
    {
        $validator = new CurrencyValidator();

        $this->assertFalse($validator->checkCurrency('error-currency'));
    }
}
