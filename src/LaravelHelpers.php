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
     * Determine if a string is a Binary String.
     *
     * @param string $string
     * @return bool
     */
    public static function isBinary(string $string): bool
    {
        return preg_match('~[^\x20-\x7E\t\r\n]~', $string) > 0;
    }

    /**
     * Determine if a string is serialized.
     *
     * https://stackoverflow.com/questions/1369936/check-to-see-if-a-string-is-serialized/4994628
     *
     * @param $data
     * @return bool
     */
    public static function isSerialized($data): bool
    {
        // if it isn't a string, it isn't serialized
        if (! is_string($data)) {
            return false;
        }
        $data = trim($data);
        if ('N;' == $data) {
            return true;
        }
        if (! preg_match('/^([adObis]):/', $data, $badions)) {
            return false;
        }
        switch ($badions[1]) {
            case 'a':
            case 'O':
            case 's':
                if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data)) {
                    return true;
                }
                break;
            case 'b':
            case 'i':
            case 'd':
                if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data)) {
                    return true;
                }
                break;
        }

        return false;
    }

    /**
     * Shorten a number by adding alphanumeric notation denoting thousands, millions, billing or trillions.
     *
     *  - example: AppInfo::formatNumber(10000) -> '10k'
     *  - https://stackoverflow.com/questions/4116499/php-count-round-thousand-to-a-k-style-count-like-facebook-share-twitter-bu/36365553
     *
     * @param int $number
     * @return string
     */
    public static function formatNumber(int $number): string
    {
        if ($number > 1000) {
            $x = round($number);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = ['k', 'm', 'b', 't'];
            $x_count_parts = count($x_array) - 1;
            $x_display = $x_array[0].((int) $x_array[1][0] !== 0 ? '.'.$x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;
        }

        return $number;
    }
}
