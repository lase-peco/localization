# A simple localization library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lase-peco/localization.svg?style=flat-square)](https://packagist.org/packages/lase-peco/localization)
[![Total Downloads](https://img.shields.io/packagist/dt/lase-peco/localization.svg?style=flat-square)](https://packagist.org/packages/lase-peco/localization)

[comment]: <> ([![Build Status]&#40;https://img.shields.io/travis/lase-peco/localization/master.svg?style=flat-square&#41;]&#40;https://travis-ci.org/lase-peco/localization&#41;)
[comment]: <> ([![Quality Score]&#40;https://img.shields.io/scrutinizer/g/lase-peco/localization.svg?style=flat-square&#41;]&#40;https://scrutinizer-ci.com/g/lase-peco/localization&#41;)

A simple localization library.

## Notes

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

Then publish the config file `localization.php` with the following command to define your application languages:

``` php
php artisan  vendor:publish --provider="LasePeco\Localization\LocalizationServiceProvider"
```

## Usage

### Get current language

Return a string with the current language `"en"`.

``` php
Localization::getCurrentLocale() 
``` 

### Get current language name

Return a string with the name of the current language `"English"`.

``` php
Localization::getCurrentLocaleName() 
``` 
### Get current language native name

Return a string with the native name of the current language `"Deutsch"`.

``` php
Localization::getCurrentLocaleNativeName() 
```
### Get current regional language 

Return a string with the current regional language `"en_GB"`.

``` php
Localization::getCurrentLocaleRegional()
``` 

### Get keys of supported languages

Return an array of supported languages in your application:


``` php
Localization::getSupportedLanguagesKeys() 
```

``` php
//return
[
  0 => "ar"
  1 => "en"
  2 => "de"
]
```
### Get supported languages

Return an associative array with the supported languages for your application:



``` php
Localization::getSupportedLocales()
```
``` php
//return
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

### Set application language

To set the language of your application use the provided route `'locale'` with the selected language as a parameter:

``` php
route('locale', [$key]) // $key = "en" or "de" or ...
```

Or make a get request to `/local/{$local}`, this will set the application language to the selected language.

### Time format

`Localization::formatDate($date)` return a string of the date formatted in native Language:

Example

``` php
$model->created_at->intlDateFormat();
// or
Localization::formatDate($model->created_at);
```
``` php
//return
'Sep 14, 2021'   // 'en' 
'14.09.2021'     // 'de'
'14 sept. 2021'  // 'fn'
'١٤‏/٠٩‏/٢٠٢١'    // 'ar'
```
### Date format
`Localization::formatTime($time)` return a string of the time formatted in native Language:

Example

``` php
$model->created_at->intlTimeFormat();
// or
Localization::formatTime($model->created_at);
```
``` php
//return
'1:27 PM'  // 'en' 
'13:27'    // 'de'
'١:٢٧ م'   // 'ar'
```
### Date-Time format
`Localization::formatDateTime($date_time)` return a string of the date and time formatted in native Language:

Example

``` php
$model->created_at->intlDateTimeFormat();
// or
Localization::formatDateTime($model->created_at);
```
``` php
// return
'Sep 14, 2021, 1:27 PM'  // 'en' 
'14.09.2021, 13:27'      // 'de'
'14 sept. 2021, 13:27'   // 'fr'
'١٤‏/٠٩‏/٢٠٢١, ١:٢٧ م'    // 'ar'
```

### Flags

`Localization::getCurrentLocaleFlag()` return html string that represents the svg flag.
`Localization::getSupportedLocalesFlags()` return an array, each item contains a html string that represents the svg flag.

The flags are set to take the full height and width of their parent tag.

Example using tailwindcss!

``` html
<div class="inline-block h-4 w-auto mr-2">{!! Localization::getCurrentLocaleFlag() !!}</div>{{Localization::getCurrentLocaleNativeName()}}
```
``` html
@foreach(Localization::getSupportedLocales() as $key => $locale)
    <a href="{{ route('locale', [$key]) }}"
       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
       role="menuitem"><span class="flex items-center"><span class="inline-block h-4 w-auto mr-2">{!! Localization::getSupportedLocalesFlags()[$key] !!}</span>{{$locale['native']}}</span></a>
@endforeach
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
