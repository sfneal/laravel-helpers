<?php

use Sfneal\Helpers\Laravel\LaravelHelpers;

/**
 * Return the alphabet in array form.
 *
 * @return array
 */
function alphabet()
{
    return LaravelHelpers::alphabet();
}

/**
 * Return the index of a letter in the alphabet.
 *
 * @param int $index
 * @return string
 */
function alphabetIndex($index)
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
function getClassName($class, $short = false, $default = null)
{
    return LaravelHelpers::getClassName($class, $short, $default);
}

/**
 * Determine if the Application is running in a 'production' environment.
 *
 * @return bool
 */
function isProductionEnvironment()
{
    return LaravelHelpers::isProductionEnvironment();
}

/**
 * Determine if the Application is running in a 'development' environment.
 *
 * @return bool
 */
function isDevelopmentEnvironment()
{
    return LaravelHelpers::isDevelopmentEnvironment();
}

/**
 * Serialize and simple hash a value to create a unique ID.
 *
 * @param $value
 * @return int
 */
function serializeHash($value)
{
    return LaravelHelpers::serializeHash($value);
}
