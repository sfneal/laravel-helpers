<?php

namespace Sfneal\Helpers\Laravel\Tests;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Orchestra\Testbench\TestCase;
use Sfneal\Helpers\Laravel\LaravelHelpers;

class LaravelHelpersTest extends TestCase
{
    /** @test */
    public function alphabet()
    {
        $expected = range('A', 'Z');
        $output = LaravelHelpers::alphabet();

        $this->assertTrue($output == $expected);
    }

    /**
     * @test
     * @throws Exception
     */
    public function alphabetIndex()
    {
        $index = random_int(1, 26);
        $expected = LaravelHelpers::alphabet()[$index];
        $output = LaravelHelpers::alphabetIndex($index);

        $this->assertTrue($output == $expected);
    }

    /** @test */
    public function getClassName()
    {
        $expected = 'Illuminate\Database\Eloquent\Model';
        $output = LaravelHelpers::getClassName(Model::class);

        $this->assertTrue($output == $expected);
    }

    /** @test */
    public function getClassName_short()
    {
        $expected = 'Model';
        $output = LaravelHelpers::getClassName(Model::class, true);

        $this->assertTrue($output == $expected);
    }

    /** @test */
    public function serializeHash()
    {
        $expected = 1106692049;
        $output = LaravelHelpers::serializeHash("Here's a random string to hash.");

        $this->assertIsInt($output);
        $this->assertTrue($output == $expected);
    }

    /** @test */
    public function randomFloat()
    {
        $value = LaravelHelpers::randomFloat(1, 1000);

        $this->assertIsFloat($value);
    }
}
