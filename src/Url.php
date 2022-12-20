<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient;

use Cazak\CurrencyClient\ValueObject\Currency;
use Cazak\CurrencyClient\ValueObject\Date;

final readonly class Url
{
    private const ENDPOINT = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/';

    public function getEndpoint(Date $date, ?Currency $currency = null, ?Currency $secondCurrency = null): string
    {
        return self::ENDPOINT .
            $date->getDate() .
            '/currencies' .
            $this->getCurrenciesParameter($currency, $secondCurrency) .
            '.json';
    }

    private function getCurrenciesParameter(?Currency $currency = null, ?Currency $secondCurrency = null): string
    {
        $string = '';
        if ($currency) {
            $string .= '/' . $currency->getCurrency();
        }

        if ($secondCurrency) {
            $string .= '/' . $secondCurrency->getCurrency();
        }

        return $string;
    }
}
