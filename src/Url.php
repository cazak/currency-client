<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient;

final readonly class Url
{
    private const ENDPOINT = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@';

    public function __construct(private readonly int $version)
    {
    }

    public function getEndpoint(): string
    {
        return self::ENDPOINT.$this->version.'/';
    }

    public function getDefaultUrlWithDate(?string $date = null): string
    {
        return $this->getEndpoint().$this->getDateParameter($date);
    }

    private function getDateParameter(?string $date = null): string
    {
        return $date ? $date.'/' : 'latest/';
    }
}
