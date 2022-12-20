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
    private Url $url;
    public function __construct(
        private RequestFactoryInterface $requestFactory,
        private Response $response,
    ) {
        $this->url = new Url();
    }

    public function disableSave(): void
    {
        $this->response->disableSave();
    }

    public function currencies(Date $date = new Date())
    {
        $request = $this->requestFactory->createRequest('GET',
            $this->url->getEndpoint($date)
        );

        return $this->response->request($request);
    }

    public function getRateByCurrency(Currency $baseCurrency, Currency $currency, Date $date = new Date())
    {
        $request = $this->requestFactory->createRequest(
            'GET',
            $this->url->getEndpoint($date, $baseCurrency, $currency)
        );

        return $this->response->request($request);
    }

    public function getRatesByBaseCurrency(Currency $baseCurrency, Date $date = new Date())
    {
        $request = $this->requestFactory->createRequest(
            'GET',
            $this->url->getEndpoint($date, $baseCurrency)
        );

        return $this->response->request($request);
    }
}
