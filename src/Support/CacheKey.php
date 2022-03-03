<?php

namespace Sfneal\Helpers\Laravel\Support;

use Sfneal\Actions\Action;

class CacheKey extends Action
{
    /**
     * @var string
     */
    private $item;

    /**
     * @var string|null
     */
    private $identifier;

    /**
     * CacheKey constructor.
     *
     * @param  string  $item
     * @param  string|null  $identifier
     */
    public function __construct(string $item, string $identifier = null)
    {
        $this->item = $item;
        $this->identifier = (isset($identifier) ? ':'.$identifier : '');
    }

    /**
     * Retrieve a cache key for a particular service item.
     *
     * @return string
     */
    public function execute(): string
    {
        return config('app-info.cache_prefix').':'.$this->item.$this->identifier;
    }
}
