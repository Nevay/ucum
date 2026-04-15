# UCUM parser

Parser for *Unified Code for Units of Measure* ([UCUM]) units.

## Installation

```shell
composer require tbachert/ucum
```

## Usage

#### Converting between units

```php
use Nevay\Ucum\Unit;

$factor = Unit::convert('km/h', 'm/s');
$factor->apply(72); // 20

$factor = Unit::convert('%', '1');
$factor->apply(42); // 0.42
```


[UCUM]: https://ucum.org/
