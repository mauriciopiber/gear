<?php
namespace Gear\Mvc\Mapping;

use Gear\Mvc\Repository\MappingService;

trait MappingServiceTrait
{
    protected $mappingService;

    public function getMappingService()
    {
        return $this->mappingService;
    }

    public function setMappingService($mappingService)
    {
        $this->mappingService = $mappingService;
        return $this;
    }
}
