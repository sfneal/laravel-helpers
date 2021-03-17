<?php


namespace Sfneal\Helpers\Laravel\Support;


use Sfneal\Actions\AbstractAction;

class Changelog extends AbstractAction
{
    /**
     * @var string
     */
    private $path;

    /**
     * Changelog constructor.
     *
     * @param string|null $path
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
    public function execute(): array
    {
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
    }
}
