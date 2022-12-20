<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient;

use Cazak\CurrencyClient\Storage\Storage;
use Cazak\CurrencyClient\ValueObject\Currency;
use Cazak\CurrencyClient\ValueObject\Date;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

final readonly class Client
{
    private const END_STRING = '.json';
    private const VERSION = 1;

    public function __construct(
        private ClientInterface $client,
        private Storage $storage,
        private RequestFactoryInterface $requestFactory,
        private Url $url = new Url(self::VERSION),
    ) {
    }

    public function currencies(Date $date = new Date()): array
    {
        $request = $this->requestFactory->createRequest('GET', $this->url->getDefaultUrlWithDate($date->getDate()).'currencies'.self::END_STRING);

        return $this->saveDataAndReturnResponse($this->client->sendRequest($request)->getBody()->getContents());
    }

    public function getRateByCurrency(Currency $baseCurrency, Currency $currency, Date $date): array
    {
        $request = $this->requestFactory->createRequest(
            'GET',
            $this->url->getDefaultUrlWithDate($date->getDate()).'currencies/'.$baseCurrency->getCurrency().'/'.$currency->getCurrency().self::END_STRING
        );

        return $this->saveDataAndReturnResponse($this->client->sendRequest($request)->getBody()->getContents());
    }

    public function getRatesByBaseCurrency(Currency $baseCurrency, Date $date): array
    {
        $request = $this->requestFactory->createRequest(
            'GET',
            $this->url->getDefaultUrlWithDate($date->getDate()).'currencies/'.$baseCurrency->getCurrency().self::END_STRING
        );

        return $this->saveDataAndReturnResponse($this->client->sendRequest($request)->getBody()->getContents());
    }

    private function saveDataAndReturnResponse(string $response): array
    {
        $data = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        $this->storage->save($data);

        return $data;
    }
}
