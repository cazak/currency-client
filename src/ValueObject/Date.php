<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\ValueObject;
use InvalidArgumentException;

final readonly class Date
{
    public function __construct(private ?string $date = null)
    {
        $pattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

        if ($this->date === null || $this->date === 'latest') {
            return;
        }

        if (!preg_match($pattern, $this->date)) {
            throw new InvalidArgumentException('Incorrect date');
        }
    }

    public function getDate(): ?string
    {
        return $this->date;
    }
}
