<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Model;

final readonly class Currencies implements Model
{
    public function __construct(private array $items)
    {
    }

    public function getRawData(): array
    {
        return $this->items;
    }
}
