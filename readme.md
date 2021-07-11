# Radon

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

A library like [Carbon](https://github.com/briannesbitt/Carbon) but for Iranian (Jalali) calendar

## Installation

Via Composer

``` bash
$ composer require wamadev/radon
```

## Usage

### Create new instance
Just like when you would do `now()` and get a Carbon instance, you can do `jnow()` and get a Radon instance for the current time.

To make a new instance based on the given datetime, you can use `radon($datetimeString)` like:
`$r = radon('1401-12-28 06:15')`
and get a new instance for that datetime

### Conversions

To convert Carbon instances to Radon instances, do:
```
$carbonInstance->toJalali(); // returns Radon instance and converts the date from gregorian to jalali
```

To do the vice versa (Radon to Carbon), do:
```
$radonInstance->toGregorian(); // returns Carbon instance and converts the date from jalali to gregorian
```

### Methods

You can use most of the carbon's methods on a Radon instance. e.g. `$radonInstance->diffForHumans()`, `$radonInstance->addDay(10)`, `$radonInstance->setDay(1)`

### Casts

You can use the Radon cast to make the conversion process easier. To use the cast, add the cast to your field in the respective model:

```php
use Wama\Radon\Casts\JalaliDatetime;

class Product extends Model {
  protected $casts = [
    'sales_ends_at' => JalaliDatetime::class,
    'updated_at' => JalaliDatetime::class,
    'created_at' => JalaliDatetime::class,
  ];  
}
```
and get a Radon instance every time you get the field. 
`$product->sales_ends_at // returns a Radon instance`

you can also update the model without having to worry about the datetime conversions:
```php
$product->update([
  'sales_ends_at' => radon('1401-01-14 23:00'), // Sales will end at Farvardin 14th
]);
```
or 
```php
$product->sales_ends_at->addMonth();
$product->save();
```

## Expansion

Radon tries to support most of the Carbon methods, but keep in mind that some of the Carbon methods are not supported _yet_ and might be added in the next versions.
This package uses [Verta](https://github.com/hekmatinasser/verta) under the hood and therefore, expanding some functionalities might demand on the expansion of Verta.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Alireza Zamani][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/wamadev/radon.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/wamadev/radon.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/wamadev/radon/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/wamadev/radon
[link-downloads]: https://packagist.org/packages/wamadev/radon
[link-travis]: https://travis-ci.org/wamadev/radon
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/alitnk
[link-contributors]: ../../contributors
