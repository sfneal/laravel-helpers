<?php

namespace Sfneal\Helpers\Laravel;

use ErrorException;
use Illuminate\Support\Facades\Cache;
use Sfneal\Helpers\Strings\StringHelpers;

class AppInfo
{
    // todo: add config values for version?

    /**
     * Redis Cache Key prefix.
     */
    private const CACHE_PREFIX = 'app';

    /**
     * Retrieve the Application's version.
     *
     * @return mixed
     */
    public static function version()
    {
        return Cache::rememberForever(self::cacheKey('version'), function () {
            // toto: refactor environment method to AppInfo
            return config('app-info.version').(LaravelHelpers::isDevelopmentEnvironment() ? ' (dev)' : '');
        });
    }

    /**
     * Retrieve an array of changes made to a particular application version.
     *
     * @param string|null $version
     *
     * @return mixed
     */
    public static function versionChanges(string $version = null)
    {
        // Get current version changes if $version wasn't passed
        $version = $version ?? self::version();

        return Cache::rememberForever(self::cacheKey('changelog', $version), function () use ($version) {
            try {
                return self::changelog()[$version];
            } catch (ErrorException $exception) {
            }
        });
    }

    /**
     * Retrieve the Application's changelog.
     *
     * @return mixed
     */
    public static function changelog()
    {
        return Cache::rememberForever(self::cacheKey('changelog'), function () {
            // Read the changelog
            $file_lines = file(config('app-info.changelog_path'));
            $changes = [];

            for ($row = 0; $row < count($file_lines); $row++) {
                // Check if line starts with 'version'
                if (substr(strtolower($file_lines[$row]), 0, strlen('version')) == 'version') {
                    $version_date = explode(', ', $file_lines[$row]);

                    // Extract version and date
                    $date = $version_date[1];
                    $version = explode(' ', $version_date[0])[1];
                    $changes[$version] = ['date' => $date, 'changes' => []];

                    // Skip ahead two lines to skip sep line
                    $row += 2;

                    // Keep iterating over rows until we get to a blank line
                    while ($row < count($file_lines) && strlen(trim($file_lines[$row])) > 1) {
                        if (substr(trim($file_lines[$row]), 0, 1) == '-') {
                            $changes[$version]['changes'][] = str_replace('- ', '', trim($file_lines[$row]));
                            $row++;
                        } else {
                            break;
                        }
                    }
                }
            }

            return $changes;
        });
    }

    /**
     * Determine if a particular Version is running.
     *
     * @param string $version
     *
     * @return mixed
     */
    public static function isVersion(string $version): bool
    {
        return Cache::rememberForever(self::cacheKey("version#is-{$version}"), function () use ($version) {
            return self::version() == $version;
        });
    }

    /**
     * Determine if a particular Version is running.
     *
     * @param string $version
     *
     * @return mixed
     */
    public static function isNotVersion(string $version): bool
    {
        return ! self::isVersion($version);
    }

    /**
     * Determine if a 'BETA' version is running.
     *
     * @return mixed
     */
    public static function isVersionTagBeta(): bool
    {
        return self::isVersionTag('beta');
    }

    /**
     * Determine if a particular tag version is running (beta, dev, staging, etc..).
     *
     * @param string $tag
     *
     * @return mixed
     */
    public static function isVersionTag(string $tag): bool
    {
        return Cache::rememberForever(self::cacheKey("version#is-{$tag}"), function () use ($tag) {
            return (new StringHelpers(self::version()))->inString($tag);
        });
    }

    /**
     * Retrieve a cache key for a particular service item.
     *
     * @param string      $item
     * @param string|null $identifier
     *
     * @return string
     */
    private static function cacheKey(string $item, string $identifier = null): string
    {
        return self::CACHE_PREFIX.':'.$item.(isset($identifier) ? '#'.$identifier : '');
    }
}
