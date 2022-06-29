<?php

namespace LasePeco\Localization\Tests;

use Carbon\Carbon;
use LasePeco\Localization\LocalizationServiceProvider;
use Orchestra\Testbench\TestCase;

class LocalizationTest extends TestCase
{
    public function testGetSupportedLocals()
    {
        $this->assertEquals(
            app('config')->get('localization.languages')
            , app('localization')->getSupportedLocales());
    }

    public function testSetLocale()
    {
        $this->assertEquals('en', app('localization')->getCurrentLocale());

        app('localization')->setLocale('de');

        $this->assertEquals('de', app('localization')->getCurrentLocale());
    }

    public function testGetCurrentLocale()
    {
        $this->assertEquals(
            'en',
            app('localization')->getCurrentLocale()
        );

        app('localization')->setLocale('de');
        $this->assertEquals(
            'de',
            app('localization')->getCurrentLocale()
        );

        $this->assertNotEquals(
            'en',
            app('localization')->getCurrentLocale()
        );
    }

    public function testGetCurrentLocaleRegional()
    {
        $this->assertEquals(
            'en_GB',
            app('localization')->getCurrentLocaleRegional()
        );

        app('localization')->setLocale('de');

        $this->assertEquals(
            'de_DE',
            app('localization')->getCurrentLocaleRegional()
        );
    }

    public function testFormatDate()
    {
        app('localization')->setLocale('de');

        $this->assertEquals('20.04.2021', app('localization')->formatDate(Carbon::create(2021, 04, 20)));
    }

    public function testFormatTime()
    {
        app('localization')->setLocale('de');

        $this->assertEquals('14:10', app('localization')->formatTime(Carbon::create(null, null, null, 14, 10)));
    }

    public function testFormatDateTime()
    {
        app('localization')->setLocale('de');

        $this->assertEquals('20.04.2021, 14:10', app('localization')->formatDateTime(Carbon::create(2021, 04, 20, 14, 10)));
    }

    public function testFormatDateTimeWithTimezone()
    {
        $localization = app('localization');

        $localization->setLocale('de');
        $localization->setTimezone('Europe/Berlin');

        $this->assertEquals('20.04.2021, 16:10', app('localization')->formatDateTime(Carbon::create(2021, 04, 20, 14, 10)));
    }


    public function testGetCurrentLocaleName()
    {
        $this->assertEquals(
            'English',
            app('localization')->getCurrentLocaleName()
        );

        app('localization')->setLocale('de');

        $this->assertEquals(
            'German',
            app('localization')->getCurrentLocaleName()
        );
    }

    public function testGetCurrentLocaleNativeName()
    {
        $this->assertEquals(
            'English',
            app('localization')->getCurrentLocaleNativeName()
        );

        app('localization')->setLocale('de');

        $this->assertEquals(
            'Deutsch',
            app('localization')->getCurrentLocaleNativeName()
        );
    }

    public function testGetSupportedLanguagesKeys()
    {
        $this->assertEquals(
            ['en', 'de'],
            app('localization')->getSupportedLanguagesKeys()
        );
    }

    public function testSetLocaleRoute()
    {
        $this->get(route('locale', ['de']))->assertRedirect();
    }

    protected function getPackageProviders($app)
    {
        return [LocalizationServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Localization' => 'LasePeco\Localization\Localization'
        ];
    }
}
