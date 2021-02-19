<?php

use Sfneal\Helpers\Laravel\LaravelHelpers;

/**
 * Return the alphabet in array form.
 *
 * @return array
 */
function alphabet(): array
{
    return LaravelHelpers::alphabet();
}

/**
 * Return the index of a letter in the alphabet.
 *
 * @param int $index
 * @return string
 */
function alphabetIndex(int $index): string
{
    return LaravelHelpers::alphabetIndex($index);
}

/**
 * Retrieve a class's short name (without namespace).
 *
 * @param $class
 * @param bool $short Full name or short name
 * @param string|null $default
 * @return string
 */
function getClassName($class, $short = false, $default = null): string
{
    return LaravelHelpers::getClassName($class, $short, $default);
}

/**
 * Determine if the Application is running in a 'production' environment.
 *
 * @return bool
 */
function isProductionEnvironment(): bool
{
    return LaravelHelpers::isProductionEnvironment();
}

/**
 * Determine if the Application is running in a 'development' environment.
 *
 * @return bool
 */
function isDevelopmentEnvironment(): bool
{
    return LaravelHelpers::isDevelopmentEnvironment();
}

/**
 * Serialize and simple hash a value to create a unique ID.
 *
 * @param $value
 * @return int
 */
function serializeHash($value): int
{
    return LaravelHelpers::serializeHash($value);
}

/**
 * Retrieve a random float between two values with a specified number of decimals.
 *
 * @param $min
 * @param $max
 * @param int $decimals
 * @return float
 */
function randomFloat(int $min, int $max, int $decimals = 2): float
{
    return LaravelHelpers::randomFloat($min, $max, $decimals);
}

/**
 * Determine if a string is a Binary String
 *
 * @param string $string
 * @return bool
 */
function isBinary(string $string): bool
{
    return LaravelHelpers::isBinary($string);
}

/**
 * Determine if a string is serialized.
 *
 * https://stackoverflow.com/questions/1369936/check-to-see-if-a-string-is-serialized/4994628
 *
 * @param $data
 * @return bool
 */
function isSerialized($data): bool
{
    return LaravelHelpers::isSerialized($data);
}
