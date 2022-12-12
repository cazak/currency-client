<?php

namespace Cazak\CurrencyClient\Storage;

interface Storage
{
    public function save(array $items): void;
}