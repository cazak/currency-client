<?php

namespace Cazak\CurrencyClient\Storage;

use Cazak\CurrencyClient\Model\Model;

interface Storage
{
    public function save(Model $model): void;
}
