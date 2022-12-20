<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient;

use Psr\Http\Message\ResponseInterface;

final class ResponseMapper
{
    public function map(ResponseInterface $response)
    {
        return $response->getBody()->getContents();
    }
}
