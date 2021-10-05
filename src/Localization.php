<?php

namespace LasePeco\Localization;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use IntlDateFormatter;

class Localization
{
    public function formatDate($date_time)
    {
        return (new IntlDateFormatter($this->getCurrentLocale(), IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE))->format($date_time);
    }

    /**
     * @return string
     */
    public function getCurrentLocale()
    {
        return App::getLocale();
    }

    public function formatTime($date_time)
    {
        return (new IntlDateFormatter($this->getCurrentLocale(), IntlDateFormatter::NONE, IntlDateFormatter::SHORT))->format($date_time);
    }

    public function formatDateTime($date_time)
    {
        return (new IntlDateFormatter($this->getCurrentLocale(), IntlDateFormatter::MEDIUM, IntlDateFormatter::SHORT))->format($date_time);
    }

    public function getCurrentLocaleName()
    {
        return $this->getSupportedLocales()[$this->getCurrentLocale()]['name'];
    }

    /**
     * @return array
     */
    public function getSupportedLocales()
    {
        return app('config')->get('localization.languages');
    }

    /**
     * @return string
     */
    public function getCurrentLocaleNativeName()
    {
        return $this->getSupportedLocales()[$this->getCurrentLocale()]['native'];
    }

    public function setLocale(string $locale)
    {
        App::setLocale($locale);

        if ($regional = $this->getCurrentLocaleRegional()) {
            setlocale(LC_TIME, $regional);
            setlocale(LC_MONETARY, $regional);
        }
    }

    /**
     * @return string
     */
    public function getCurrentLocaleRegional()
    {
        return $this->getSupportedLocales()[$this->getCurrentLocale()]['regional'];
    }

    /**
     * @return string[]
     */
    public function getSupportedLanguagesKeys()
    {
        return array_keys($this->getSupportedLocales());
    }

    /**
     * @return false|string
     */
    public function getCurrentLocaleFlag()
    {
        return file_get_contents(__DIR__ . "/../resources/flags/{$this->getCurrentLocale()}.svg");
    }

    /**
     * @return array
     */
    public function getSupportedLocalesFlags()
    {
        return collect($this->getSupportedLocales())->map(function ($value, $key) {
            return file_get_contents(__DIR__ . "/../resources/flags/{$key}.svg");
        })->toArray();
    }
}
