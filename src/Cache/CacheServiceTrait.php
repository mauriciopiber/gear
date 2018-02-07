<?php
namespace Gear\Cache;

trait CacheServiceTrait
{
    protected $cacheService;

    public function getCacheService()
    {
        if (!isset($this->cacheService)) {
            $this->cacheService = $this->getServiceLocator()->get('cacheService');
        }
        return $this->cacheService;
    }

    public function setCacheService($cacheService)
    {
        $this->cacheService = $cacheService;
        return $this;
    }
}
