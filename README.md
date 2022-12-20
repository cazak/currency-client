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
use Cazak\ValueObject\Currency;
use Cazak\ValueObject\Date;

$currencyClient = new CurrencyClient\Client(
    new \GuzzleHttp\Client(),
    new CurrencyClient\Storage\FileStorage(),
    new \GuzzleHttp\Psr7\HttpFactory(),
);

// Данные за определённую дату
$data = $currencyClient->getRatesByBaseCurrency(new Currency('eur'), new Date('2022-12-01'));
// Идентичный результат - данные за последний день
$data = $currencyClient->getRatesByBaseCurrency(new Currency('eur'), new Date('latest'));
$data = $currencyClient->getRatesByBaseCurrency(new Currency('eur'));
```

## Тесты

```bash
$ ./vendor/bin/phpunit
```
