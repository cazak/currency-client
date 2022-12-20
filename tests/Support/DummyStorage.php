<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Tests\Support;

use Cazak\CurrencyClient\Model\Model;
use Cazak\CurrencyClient\Storage\Storage;

final class DummyStorage implements Storage
{
    private Model $model;

    public function save(Model $model): void
    {
        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
