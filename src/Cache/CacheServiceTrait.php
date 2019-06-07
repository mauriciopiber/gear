<?php
namespace Gear\Cache;

trait CacheServiceTrait
{
    protected $cacheService;

    public function getCacheService()
    {
        return $this->cacheService;
    }

    public function setCacheService($cacheService)
    {
        $this->cacheService = $cacheService;
        return $this;
    }
}
