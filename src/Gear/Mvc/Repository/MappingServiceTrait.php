<?php
namespace Gear\Mvc\Mapping;

trait MappingServiceTrait {

    protected $mappingService;

    public function getMappingService()
    {
        if (!isset($this->mappingService)) {
            $this->mappingService = $this->getServiceLocator()->get('mappingService');
        }
        return $this->mappingService;
    }

    public function setMappingService($mappingService)
    {
        $this->mappingService = $mappingService;
        return $this;
    }
}
