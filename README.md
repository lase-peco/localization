# A simple localization library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lase-peco/localization.svg?style=flat-square)](https://packagist.org/packages/lase-peco/localization)
[![Total Downloads](https://img.shields.io/packagist/dt/lase-peco/localization.svg?style=flat-square)](https://packagist.org/packages/lase-peco/localization)

[comment]: <> ([![Build Status]&#40;https://img.shields.io/travis/lase-peco/localization/master.svg?style=flat-square&#41;]&#40;https://travis-ci.org/lase-peco/localization&#41;)
[comment]: <> ([![Quality Score]&#40;https://img.shields.io/scrutinizer/g/lase-peco/localization.svg?style=flat-square&#41;]&#40;https://scrutinizer-ci.com/g/lase-peco/localization&#41;)

A simple localization library.

## Notes

This document is a work in progress!

This whole package is hugly inspired by [mcamara/laravel-localization](https://github.com/mcamara/laravel-localization), we wanted something simpler, with support for PHP IntlDateFormatter so we made our own package.

## Installation

You can install the package via composer:

```bash
composer require lase-peco/localization
```

## Usage

Using the `Localization` facade you can call the following functions

``` php
Localization::getSupportedLocales();

Localization::getCurrentLocale();

Localization::getCurrentLocaleName();

Localization::getCurrentLocaleNativeName();

Localization::getCurrentLocaleRegional();

Localization::getSupportedLanguagesKeys();

Localization::setLocale('de');
```

### Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email a.dabak@lase-peco.com instead of using the issue tracker.

## Credits

- [Ahmed Dabak](https://github.com/lase-peco)
- [All Contributors](CONTRIBUTING.md)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
