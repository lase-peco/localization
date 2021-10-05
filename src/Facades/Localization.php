<?php

namespace LasePeco\Localization\Facades;

use Illuminate\Support\Facades\Facade;

/**

 * @method static string getCurrentLocale()
 * @method static string getCurrentLocaleNativeName()
 * @method static string getCurrentLocaleRegional()
 * @method static string getCurrentLocaleFlag()
 * @method static array getSupportedLocales()
 * @method static array getSupportedLanguagesKeys()
 * @method static array getSupportedLocalesFlags()
 */
class Localization extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'localization';
    }
}
