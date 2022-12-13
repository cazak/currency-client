<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient;

use Cazak\CurrencyClient\Storage\Storage;
use Cazak\CurrencyClient\Validator\CurrencyValidator;
use Cazak\CurrencyClient\Validator\DateValidator;
use InvalidArgumentException;
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
        private DateValidator $dateValidator,
        private CurrencyValidator $currencyValidator,
        private Url $url = new Url(self::VERSION),
    ) {
    }

    public function currencies(?string $date = null): array
    {
        $request = $this->requestFactory->createRequest('GET', $this->url->getDefaultUrlWithDate($date).'currencies'.self::END_STRING);

        return $this->saveDataAndReturnResponse($this->client->sendRequest($request)->getBody()->getContents());
    }

    public function getRateByCurrency(string $baseCurrency, string $currency, ?string $date = null): array
    {
        if (!$this->currencyValidator->checkCurrency($baseCurrency)) {
            throw new InvalidArgumentException('Incorrect currency');
        }
        if (!$this->currencyValidator->checkCurrency($currency)) {
            throw new InvalidArgumentException('Incorrect currency');
        }
        if (!$this->dateValidator->checkDate($date)) {
            throw new InvalidArgumentException('Incorrect date format');
        }

        $request = $this->requestFactory->createRequest(
            'GET',
            $this->url->getDefaultUrlWithDate($date).'currencies/'.$baseCurrency.'/'.$currency.self::END_STRING
        );

        return $this->saveDataAndReturnResponse($this->client->sendRequest($request)->getBody()->getContents());
    }

    public function getRatesByBaseCurrency(string $baseCurrency, ?string $date = null): array
    {
        if (!$this->currencyValidator->checkCurrency($baseCurrency)) {
            throw new InvalidArgumentException('Incorrect currency');
        }
        if (!$this->dateValidator->checkDate($date)) {
            throw new InvalidArgumentException('Incorrect date format');
        }

        $request = $this->requestFactory->createRequest(
            'GET',
            $this->url->getDefaultUrlWithDate($date).'currencies/'.$baseCurrency.self::END_STRING
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
