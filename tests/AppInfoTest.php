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
    public function isVersion()
    {
        $output1 = AppInfo::isVersion('1.7.2');
        $this->assertIsBool($output1);
        $this->assertTrue($output1);

        $output2 = AppInfo::isVersion('1.7.3');
        $this->assertIsBool($output2);
        $this->assertFalse($output2);
    }

    /** @test */
    public function isVersionTagNotBeta()
    {
        $output = AppInfo::isVersionTagBeta();
        $this->assertIsBool($output);
        $this->assertFalse($output);
    }

    /** @test */
    public function isVersionTagBeta()
    {
        $this->app['config']->set(
            'app-info.version',
            file_get_contents(__DIR__.'/../version.txt').'-beta'
        );
        $output = AppInfo::isVersionTagBeta();

        $this->assertIsBool($output);
        $this->assertTrue($output);
    }

    /** @test */
    public function isVersionTagNotDev()
    {
        $output = AppInfo::isVersionTagDev();
        $this->assertIsBool($output);
        $this->assertFalse($output);
    }

    /** @test */
    public function isVersionTagDev()
    {
        $expected = '1.7.2 (dev)';
        $this->app['config']->set('app.env', 'development');
        $output = AppInfo::isVersionTagDev();

        $this->assertIsBool($output);
        $this->assertTrue($output);
        $this->assertEquals($expected, AppInfo::version());
    }

    /** @test */
    public function isEnvProduction()
    {
        $this->app['config']->set('app.env', 'production');
        $output = AppInfo::isEnvProduction();

        $this->assertIsBool($output);
        $this->assertTrue($output);
        $this->assertFalse(AppInfo::isEnvDevelopment());
    }

    /** @test */
    public function isEnvDevelopment()
    {
        $this->app['config']->set('app.env', 'development');
        $output = AppInfo::isEnvDevelopment();

        $this->assertIsBool($output);
        $this->assertTrue($output);
        $this->assertFalse(AppInfo::isEnvProduction());
    }

    /** @test */
    public function isEnvTesting()
    {
        $output = AppInfo::isEnvTesting();

        $this->assertIsBool($output);
        $this->assertTrue($output);
    }

    /** @test */
    public function env()
    {
        $expected1 = 'testing';
        $output1 = AppInfo::env();
        $this->assertIsString($output1);
        $this->assertEquals($expected1, $output1);

        $expected2 = 'production';
        $this->app['config']->set('app.env', $expected2);

        $output2 = AppInfo::env();
        $this->assertIsString($output2);
        $this->assertEquals($expected2, $output2);
    }
}
