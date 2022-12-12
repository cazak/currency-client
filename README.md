## Установка

С помощью `composer`

```bash
$ composer require cazak/currency-client
```

# Использование

```php
use Cazak\CurrencyClient;

$currencyClient = new CurrencyClient\Client(
new \GuzzleHttp\Client(),
new CurrencyClient\Storage\FileStorage(),
new \GuzzleHttp\Psr7\HttpFactory(),
new CurrencyClient\Validator\DateValidator(),
new CurrencyClient\Validator\CurrencyValidator(),
);

$data = $currencyClient->getRatesByBaseCurrency('eur', 'latest');
$data = $currencyClient->getRateByCurrency('eur', 'rub');
```