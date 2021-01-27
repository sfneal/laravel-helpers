<?php

use Illuminate\Support\Facades\Cache;

/**
 * Return the alphabet in array form.
 *
 * @return array
 */
function alphabet()
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
function alphabetIndex($index)
{
    return alphabet()[$index];
}

/**
 * Retrieve a class's short name (without namespace).
 *
 * @param $class
 * @param bool $short Full name or short name
 * @param string|null $default
 * @return string
 */
function getClassName($class, $short = false, $default = null)
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
function isProductionEnvironment()
{
    return env('APP_ENV') == 'production';
}

/**
 * Determine if the Application is running in a 'development' environment.
 *
 * @return bool
 */
function isDevelopmentEnvironment()
{
    return env('APP_ENV') == 'development';
}

/**
 * Serialize and simple hash a value to create a unique ID.
 *
 * @param $value
 * @return int
 */
function serializeHash($value)
{
    return crc32(serialize($value));
}
