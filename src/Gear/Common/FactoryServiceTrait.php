<?php
namespace Gear\Common;

trait FactoryServiceTrait {

    protected $factoryService;

    public function getFactoryService()
    {
        if (!isset($this->factoryService)) {
            $this->factoryService = $this->getServiceLocator()->get('factoryService');
        }
        return $this->factoryService;
    }

    public function setFactoryService($factoryService)
    {
        $this->factoryService = $factoryService;
        return $this;
    }
}
