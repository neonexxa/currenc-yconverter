# PHP Currency Converter

This is a simple library for working with [free.currencyconverterapi.com](https://free.currencyconverterapi.com). Be sure that you signup and get your api token from there.

[https://free.currencyconverterapi.com/free-api-key](https://free.currencyconverterapi.com/free-api-key) 

## Installation

### Composer

```composer require neonexxa/currency-converter```

### Github

Just download any of the release or clone this repository. Feel free to use the way you want it.

## How to use

### Convert

Be sure that you save the result. Result you get the is the amount after convertion.

```php
use Neonexxa\CurrencyConverter\CurrencyConverter;

$converterclass = new CurrencyConverter([
    'api_key' => 'your_api_key',
    'currency' => 'USD_MYR' //example for converting USD to MYR
]);
$converted_amount = $converterclass->convert("1460");

```
### Getting Currency list

can visit the site currencyconverterapi with your api token https://free.currencyconverterapi.com/api/v6/currencies?apiKey=your_api_key you will get the result in json.  

nothing yet ..