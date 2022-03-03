<?php

namespace Sfneal\Helpers\Laravel\Support;

use ErrorException;
use Illuminate\Support\Facades\Cache;

class Changelog
{
    // todo: add ability to replace package names (user/package) with github links

    /**
     * @var string
     */
    private $path;

    /**
     * Changelog constructor.
     *
     * @param  string|null  $path
     */
    public function __construct(string $path = null)
    {
        $this->path = $path ?? config('app-info.changelog_path');
    }

    /**
     * Read the application's changelog & return an array of changes.
     *
     * @return array
     */
    public function changelog(): array
    {
        return Cache::rememberForever((new CacheKey("changelog:$this->path", 'changelog'))->execute(), function () {
            // Read the changelog
            $file_lines = file($this->path);
            $changes = [];

            for ($row = 0; $row < count($file_lines); $row++) {
                // Check if line starts with 'version'
                if (substr(strtolower($file_lines[$row]), 0, strlen('version')) == 'version') {
                    $version_date = explode(', ', $file_lines[$row]);

                    // Extract version and date
                    $date = $version_date[1];
                    $version = explode(' ', $version_date[0])[1];
                    $changes[$version] = ['date' => trim($date), 'changes' => []];

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
     * Retrieve an array of changes made to a particular application version.
     *
     * @param  string|null  $version
     * @return array|null
     */
    public function versionChanges(string $version): ?array
    {
        return Cache::rememberForever(
            // Cache key
            (new CacheKey("changelog:$this->path", $version))->execute(),

            // Value to cache
            function () use ($version) {
                try {
                    return $this->changelog()[$version];
                } catch (ErrorException $exception) {
                    return null;
                }
            }
        );
    }

    /**
     * Retrieve an array of the version history.
     *
     *  - optionally include the release date in the array values
     *
     * @param  bool  $releaseDates
     * @return array
     */
    public function versions(bool $releaseDates = false): array
    {
        // Flat array of versions
        $versions = array_keys($this->changelog());

        // Return an array of version keys & release date values
        if ($releaseDates) {
            // todo: optimize this
            return array_combine(
                $versions,
                array_map(
                    function ($array) {
                        return $array['date'];
                    },
                    array_values($this->changelog())
                )
            );
        }

        // Return a array of versions
        else {
            return $versions;
        }
    }
}
