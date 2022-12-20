<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient;

use Cazak\CurrencyClient\Storage\FileStorage;
use Cazak\CurrencyClient\Storage\Storage;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

final class Response
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly ResponseMapper $mapper = new ResponseMapper(),
        private readonly Storage $storage = new FileStorage(),
        private bool $needSafe = true,
    ) {
    }

    public function disableSave(): void
    {
        $this->needSafe = false;
    }

    public function request(RequestInterface $request)
    {
        $response = $this->client->sendRequest($request);

        $mappedResponse = $this->mapper->map($response);

        if ($this->needSafe) {
            $this->storage->save($mappedResponse);
        }

        return $mappedResponse;
    }
}
