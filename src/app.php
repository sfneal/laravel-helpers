<?php

use Illuminate\Support\Facades\Cache;


/**
 * Return the alphabet in array form
 *
 * @return array
 */
function alphabet(): array {
    return Cache::rememberForever('alphabet', function () {
        return range('A', 'Z');
    });
}

/**
 * Return the index of a letter in the alphabet
 *
 * @param int $index
 * @return string
 */
function alphabetIndex(int $index): string {
    return alphabet()[$index];
}


/**
 * Retrieve a class's short name (without namespace)
 *
 * @param $class
 * @param bool $short Full name or short name
 * @param string|null $default
 * @return string
 */
function getClassName($class, $short = false, string $default = null): string
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
 * Determine if the Application is running in a 'production' environment
 *
 * @return bool
 */
function isProductionEnvironment(): bool
{
    return env('APP_ENV') == 'production';
}


/**
 * Determine if the Application is running in a 'development' environment
 *
 * @return bool
 */
function isDevelopmentEnvironment(): bool
{
    return env('APP_ENV') == 'development';
}
