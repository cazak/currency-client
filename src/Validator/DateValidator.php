<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Validator;

final class DateValidator
{
    public function checkDate(?string $date = null): bool
    {
        $pattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

        if ('latest' === $date) {
            return true;
        }

        if ($date && !preg_match($pattern, $date)) {
            return false;
        }

        return true;
    }
}
