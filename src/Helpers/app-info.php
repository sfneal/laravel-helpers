<?php

use Sfneal\Helpers\Laravel\AppInfo;

/**
 * Shortcode helper function for retrieving the application's version.
 *
 * @return mixed
 */
function version()
{
    return AppInfo::version();
}

/**
 * Determine if the Application is running in a 'production' environment.
 *
 * @return bool
 */
function isProductionEnvironment(): bool
{
    return AppInfo::isEnvProduction();
}

/**
 * Determine if the Application is running in a 'development' environment.
 *
 * @return bool
 */
function isDevelopmentEnvironment(): bool
{
    return AppInfo::isEnvDevelopment();
}
