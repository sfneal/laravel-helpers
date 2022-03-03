<?php

namespace Sfneal\Helpers\Laravel\Tests;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Helpers\Laravel\Providers\AppInfoServiceProvider;

class TestCase extends OrchestraTestCase
{
    /**
     * Define environment setup.
     *
     * @param  Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.debug', true);

        $app['config']->set(
            'app-info.version',
            file_get_contents(__DIR__.'/../version.txt')
        );
        $app['config']->set(
            'app-info.changelog_path',
            __DIR__.'/../changelog.txt'
        );
    }

    /**
     * Register package service providers.
     *
     * @param  Application  $app
     * @return array|string
     */
    protected function getPackageProviders($app)
    {
        return [
            AppInfoServiceProvider::class,
        ];
    }
}
