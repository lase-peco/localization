# A simple localization library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lase-peco/localization.svg?style=flat-square)](https://packagist.org/packages/lase-peco/localization)
[![Total Downloads](https://img.shields.io/packagist/dt/lase-peco/localization.svg?style=flat-square)](https://packagist.org/packages/lase-peco/localization)

[comment]: <> ([![Build Status]&#40;https://img.shields.io/travis/lase-peco/localization/master.svg?style=flat-square&#41;]&#40;https://travis-ci.org/lase-peco/localization&#41;)
[comment]: <> ([![Quality Score]&#40;https://img.shields.io/scrutinizer/g/lase-peco/localization.svg?style=flat-square&#41;]&#40;https://scrutinizer-ci.com/g/lase-peco/localization&#41;)

A simple localization library.

## Notes

This document is a work in progress!

This whole package is hugely inspired by [mcamara/laravel-localization](https://github.com/mcamara/laravel-localization), we wanted something simpler, with support for PHP IntlDateFormatter, so we made our package.

## Installation

You can install the package via composer:

```bash
composer require lase-peco/localization
```

Then in your Web kernel file `app/Http/Kernel.php` in the `web` array in `$middlewareGroups`, add this line to the end of the array:

```php
'web' => [
     // Other middlewares
     //
     \LasePeco\Localization\Http\Middleware\Localization::class,
],
```
then publish the config file `localization.php` with the following command to define your application languages:


``` php
php artisan  vendor:publish --provider="LasePeco\Localization\LocalizationServiceProvider"
```

## Usage

Using the `Localization` facade, you can call the following functions:


-`Localization::getCurrentLocale();` returns a string with the current language `"en"`.

-`Localization::getCurrentLocaleName();` returns a string with the name of the current language `"English"`.

-`Localization::getCurrentLocaleNativeName();` returns a string with the native name of the current language `"Deutsch"`.

-`Localization::getCurrentLocaleRegional();` returns a string with the current regional language `"en_GB"`.

-`Localization::getSupportedLanguagesKeys();` returns an array of supported languages in your application:
``` php
[
  0 => "ar"
  1 => "en"
  2 => "de"
]
```
-`Localization::getSupportedLocales();` returns an associative array with the supported languages for your application:

``` php
[
  "en" => [
    "direction" => "ltr"
    "regional" => "en_GB"
    "name" => "English"
    "native" => "English"
  ]
  "de" => [
    "direction" => "ltr"
    "regional" => "de_DE"
    "name" => "German"
    "native" => "Deutsch"
  ]
]
```

### Setting application language

To set the language of your application use the provided route `'locale'` with the selected language as a parameter:

``` php
route('locale', [$key]) // $key = "en" or "de" or ...
```
The route sets the application language to the selected language.

### Formatting time and date

-`Localization::formatDate($date)` returns a string of the date formatted in native Language:

<span style="color:gray">Example</span>

``` php
Localization::formatDate($model->created_at);
//returns
'Sep 14, 2021'   // 'en' 
'14.09.2021'     // 'de'
'14 sept. 2021'  // 'fn'
'١٤‏/٠٩‏/٢٠٢١'    // 'ar'
```

-`Localization::formatTime($time)` returns a string of the time formatted in native Language:

<span style="color:gray">Example</span>

``` php
Localization::formatTime($model->created_at);
//returns
'1:27 PM'  // 'en' 
'13:27'    // 'de'
'١:٢٧ م'   // 'ar'
```

-`Localization::formatDateTime($date_time)` returns a string of the date and time formatted in native Language:

<span style="color:gray">Example</span>

``` php
Localization::formatDateTime($model->created_at);
//returns
'Sep 14, 2021, 1:27 PM'  // 'en' 
'14.09.2021, 13:27'      // 'de'
'14 sept. 2021, 13:27'   // 'fr'
'١٤‏/٠٩‏/٢٠٢١, ١:٢٧ م'    // 'ar'
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
