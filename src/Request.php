<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient;

use Cazak\CurrencyClient\Model\Model;
use Cazak\CurrencyClient\Storage\FileStorage;
use Cazak\CurrencyClient\Storage\Storage;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

final class Request
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly Storage $storage = new FileStorage(),
        private readonly ResponseMapper $mapper = new ResponseMapper(),
        private bool $needSave = true,
    ) {
    }

    public function disableSave(): void
    {
        $this->needSave = false;
    }

    public function request(RequestInterface $request, string $class): Model
    {
        $response = $this->client->sendRequest($request);

        $mappedResponse = $this->mapper->map($response, $class);

        if ($this->needSave) {
            $this->storage->save($mappedResponse);
        }

        return $mappedResponse;
    }
}
