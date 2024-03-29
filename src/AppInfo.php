<?php

namespace Sfneal\Helpers\Laravel;

use Illuminate\Support\Facades\Cache;
use Sfneal\Helpers\Laravel\Support\CacheKey;
use Sfneal\Helpers\Laravel\Support\Changelog;
use Sfneal\Helpers\Strings\StringHelpers;

class AppInfo
{
    /**
     * Retrieve the Application's version.
     *
     * @return string
     */
    public static function version(): string
    {
        return Cache::rememberForever(
            // Cache key
            (new CacheKey('version'))->execute(),

            // Value to cache
            function () {
                return trim(config('app-info.version')).(self::isEnvDevelopment() ? ' (dev)' : '');
            }
        );
    }

    /**
     * Retrieve an array of changes made to a particular application version.
     *
     * @param  string|null  $version
     * @return array|null
     */
    public static function versionChanges(string $version = null): ?array
    {
        // Get current version changes if $version wasn't passed
        return (new Changelog())->versionChanges($version ?? self::version());
    }

    /**
     * Retrieve the Application's changelog.
     *
     * @return array
     */
    public static function changelog(): array
    {
        return (new Changelog())->changelog();
    }

    /**
     * Determine if a particular Version is running.
     *
     * @param  string  $version
     * @return mixed
     */
    public static function isVersion(string $version): bool
    {
        return self::version() == $version;
    }

    /**
     * Determine if a particular Version is running.
     *
     * @param  string  $version
     * @return mixed
     */
    public static function isNotVersion(string $version): bool
    {
        return ! self::isVersion($version);
    }

    /**
     * Determine if a 'beta' version is running.
     *
     * @return mixed
     */
    public static function isVersionTagBeta(): bool
    {
        return self::isVersionTag('beta');
    }

    /**
     * Determine if a 'dev' version is running.
     *
     * @return mixed
     */
    public static function isVersionTagDev(): bool
    {
        return self::isVersionTag('dev');
    }

    /**
     * Determine if a particular tag version is running (beta, dev, staging, etc..).
     *
     * @param  string  $tag
     * @return mixed
     */
    public static function isVersionTag(string $tag): bool
    {
        return Cache::rememberForever(
            // Cache key
            (new CacheKey('version', "is-{$tag}"))->execute(),

            // Value to cache
            function () use ($tag) {
                return (new StringHelpers(self::version()))->inString($tag);
            }
        );
    }

    /**
     * Determine if the Application is running in a 'production' environment.
     *
     * @return bool
     */
    public static function isEnvProduction(): bool
    {
        return self::isEnv('production');
    }

    /**
     * Determine if the Application is running in a 'development' environment.
     *
     * @return bool
     */
    public static function isEnvDevelopment(): bool
    {
        return self::isEnv('development');
    }

    /**
     * Determine if the Application is running in a 'testing' environment.
     *
     * @return bool
     */
    public static function isEnvTesting(): bool
    {
        return self::isEnv('testing');
    }

    /**
     * Determine if the application is in a particular environment.
     *
     * @param  string  $env
     * @return bool
     */
    public static function isEnv(string $env): bool
    {
        return self::env() == $env;
    }

    /**
     * Retrieve the application's environment.
     *
     * @return string|null
     */
    public static function env(): ?string
    {
        return config('app.env');
    }
}
