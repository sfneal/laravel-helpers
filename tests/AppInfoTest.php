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
}
