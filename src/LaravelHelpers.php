<?php

namespace Sfneal\Helpers\Laravel;

use Illuminate\Support\Facades\Cache;
use ReflectionClass;
use ReflectionException;

class LaravelHelpers
{
    /**
     * Return the alphabet in array form.
     *
     * @return array
     */
    public static function alphabet(): array
    {
        return Cache::rememberForever('alphabet', function () {
            return range('A', 'Z');
        });
    }

    /**
     * Return the index of a letter in the alphabet.
     *
     * @param int $index
     * @return string
     */
    public static function alphabetIndex(int $index): string
    {
        return self::alphabet()[$index];
    }

    /**
     * Retrieve a class's short name (without namespace).
     *
     * @param $class
     * @param bool $short Full name or short name
     * @param string|null $default
     * @return string
     */
    public static function getClassName($class, $short = false, $default = null): string
    {
        // Attempt to resolve the $class's name
        try {
            return (new ReflectionClass($class))->{$short ? 'getShortName' : 'getName'}();
        }

        // Return $default
        catch (ReflectionException $e) {
            return $default;
        }
    }

    /**
     * Determine if the Application is running in a 'production' environment.
     *
     * @return bool
     */
    public static function isProductionEnvironment(): bool
    {
        return env('APP_ENV') == 'production';
    }

    /**
     * Determine if the Application is running in a 'development' environment.
     *
     * @return bool
     */
    public static function isDevelopmentEnvironment(): bool
    {
        return env('APP_ENV') == 'development';
    }

    /**
     * Serialize and simple hash a value to create a unique ID.
     *
     * @param $value
     * @return int
     */
    public static function serializeHash($value): int
    {
        return crc32(serialize($value));
    }

    /**
     * Retrieve a random float between two values with a specified number of decimals.
     *
     * @param $min
     * @param $max
     * @param int $decimals
     * @return float
     */
    public static function randomFloat(int $min, int $max, int $decimals = 2): float
    {
        $decimal = str_pad('1', $decimals + 1, '0');

        return rand($min, $max) + (rand(1, $decimal) / $decimal);
    }

    /**
     * Determine if a string is a Binary String
     *
     * @param string $string
     * @return bool
     */
    public static function isBinary(string $string): bool
    {
        return preg_match('~[^\x20-\x7E\t\r\n]~', $string) > 0;
    }
}
