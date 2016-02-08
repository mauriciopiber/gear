<?php
namespace Gear\Mvc\Factory;

trait FactoryTestServiceTrait {

    protected $factoryTestService;

    public function getFactoryTestService()
    {
        if (!isset($this->factoryTestService)) {
            $this->factoryTestService = $this->getServiceLocator()->get('factoryTestService');
        }
        return $this->factoryTestService;
    }

    public function setFactoryTestService($factoryService)
    {
        $this->factoryTestService = $factoryService;
        return $this;
    }
}
