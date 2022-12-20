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
use Cazak\CurrencyClient\Request;
use Cazak\CurrencyClient\ResponseMapper;
use Cazak\CurrencyClient\Storage\FileStorage;
use Cazak\CurrencyClient\ValueObject\Currency;
use Cazak\CurrencyClient\ValueObject\Date;

$currencyClient = new CurrencyClient\Client(
    response: new Request(storage: new FileStorage(), client: new \GuzzleHttp\Client(), mapper: new ResponseMapper()),
    requestFactory: new \GuzzleHttp\Psr7\HttpFactory(),
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
