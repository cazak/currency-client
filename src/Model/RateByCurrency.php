<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Model;

final readonly class RateByCurrency implements Model
{
    private string $date;
    private string $currency;
    private float $price;

    public function __construct(private array $array)
    {
        $this->date = $this->array['date'];
        $this->currency = array_keys($this->array)[1];
        $this->price = $this->array[array_keys($this->array)[1]];
    }

    public function getRawData(): array
    {
        return $this->array;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
