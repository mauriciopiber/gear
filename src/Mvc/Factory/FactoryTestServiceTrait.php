<?php
namespace Gear\Mvc\Factory;

use Gear\Mvc\Factory\FactoryTestService;

trait FactoryTestServiceTrait
{
    protected $factoryTestService;

    public function getFactoryTestService()
    {
        if (!isset($this->factoryTestService)) {
            $this->factoryTestService = $this->getServiceLocator()->get(FactoryTestService::class);
        }
        return $this->factoryTestService;
    }

    public function setFactoryTestService($factoryService)
    {
        $this->factoryTestService = $factoryService;
        return $this;
    }
}
