<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient;

use Cazak\CurrencyClient\Model\Model;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

final class ResponseMapper
{
    public function map(ResponseInterface $response, string $class): Model
    {
        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (!\is_subclass_of($class, Model::class)) {
            throw new InvalidArgumentException('Incorrect class');
        }

        return new $class($data);
    }
}
