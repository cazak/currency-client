<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Support;

use Cazak\CurrencyClient\Storage\Storage;

final class DummyStorage implements Storage
{
    private array $items;

    public function save(array $items): void
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
