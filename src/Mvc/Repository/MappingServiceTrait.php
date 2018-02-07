<?php
namespace Gear\Mvc\Mapping;

use Gear\Mvc\Repository\MappingService;

trait MappingServiceTrait
{
    protected $mappingService;

    public function getMappingService()
    {
        if (!isset($this->mappingService)) {
            $this->mappingService = $this->getServiceLocator()->get(MappingService::class);
        }
        return $this->mappingService;
    }

    public function setMappingService($mappingService)
    {
        $this->mappingService = $mappingService;
        return $this;
    }
}
