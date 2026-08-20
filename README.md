# UCUM parser

Parser for *Unified Code for Units of Measure* ([UCUM]) units.

## Installation

```shell
composer require tbachert/ucum
```

## Usage

### Converting between units

```php
$factor = Unit::convert('km/h', 'm/s');
$factor->apply(72); // 20

$factor = Unit::convert('%', '1');
$factor->apply(42); // 0.42
```

#### Inverse conversion

Use `Factor::applyInverse()` to convert in the opposite direction.

```php
$factor = Unit::convert('%', '1');
$factor->applyInverse(0.42); // 42.0
```

### Parsing units

For repeated conversions, or for algebraic operations, parse units once and reuse them.

```php
$meter = Unit::parse('m');
```

### Algebraic operations

#### Multiplication

```php
$newton = Unit::parse('N');
$meter = Unit::parse('m');
$joule = $newton->multiplyBy($meter);
```

#### Division

```php
$kilometer = Unit::parse('km');
$hour = Unit::parse('h');
$kilometersPerHour = $kilometer->divideBy($hour);
```

#### Exponentiation

```php
$meter = Unit::parse('m');
$squareMeter = $meter->toPower(2);
```


[UCUM]: https://ucum.org/
