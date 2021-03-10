<?php

namespace Sfneal\Helpers\Laravel\Tests;

use Sfneal\Helpers\Laravel\AppInfo;

class AppInfoTest extends TestCase
{
    /** @test */
    public function version()
    {
        $expected = '1.7.2';
        $output = AppInfo::version();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function versionChanges()
    {
        $expected = [
            'date' => '2020-12-01',
            'changes' => [
                'cut support for php5.5 & below',
            ],
        ];

        $version = '0.4.0';
        $output = AppInfo::versionChanges($version);

        $this->assertIsArray($output);
        $this->assertIsString($output['date']);
        $this->assertIsArray($output['changes']);
        $this->assertEquals($expected['date'], $output['date']);
        $this->assertEquals($expected['changes'], $output['changes']);
    }

    /** @test */
    public function changelog()
    {
        $expected = [
            '0.5.0' => [
                'date' => '2021-01-27',
                'changes' => [
                    'make LaravelHelpers class with static methods',
                    'add badges to readme',
                    'cut autoloading of helper functions in composer.json',
                    'add serializeHash method to helper functions',
                ]
            ],
            '0.4.1' => [
                'date' => '2020-12-03',
                'changes' => [
                    'fix issues with Travis CI test matrix'
                ]
            ],
            '0.4.0' => [
                'date' => '2020-12-01',
                'changes' => [
                    'cut support for php5.5 & below'
                ]
            ],
            '0.3.1' => [
                'date' => '2020-11-30',
                'changes' => [
                    'fix travis ci tests to use stable version of composer'
                ]
            ],
            '0.3.0' => [
                'date' => '2020-10-07',
                'changes' => [
                    'add support for Laravel 4 & php5'
                ]
            ],
            '0.2.0' => [
                'date' => '2020-09-08',
                'changes' => [
                    'fix composer requirements to allow for laravel/framework:8.0'
                ]
            ],
            '0.1.0' => [
                'date' => '2020-08-20',
                'changes' => [
                    'initial release'
                ]
            ],
        ];
        $output = AppInfo::changelog();

        $this->assertIsArray($output);
        $this->assertEquals($expected, $output);
    }
}
