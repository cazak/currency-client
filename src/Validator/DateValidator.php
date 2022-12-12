<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Validator;

final class DateValidator
{
    public function checkDate(?string $date = null): void
    {
        $pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";

        if ($date === 'latest') {
            return;
        }

        if ($date && !preg_match($pattern, $date)) {
            throw new \InvalidArgumentException('Incorrect date format');
        }
    }
}