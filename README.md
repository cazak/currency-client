Библиотека для работы с [валютами](https://github.com/fawazahmed0/currency-api)
- Поддерживает PSR-7

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

// Данные за определённую дату
$data = $currencyClient->getRatesByBaseCurrency('eur', '2022-12-01');
// Идентичный результат - данные за последний день
$data = $currencyClient->getRatesByBaseCurrency('eur', 'latest');
$data = $currencyClient->getRatesByBaseCurrency('eur');
```

## Тесты

```bash
$ vendor/bin/phpunit
```
