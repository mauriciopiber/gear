<?php
namespace Gear\Mvc\Factory;

use Gear\Mvc\Factory\FactoryTestService;

trait FactoryTestServiceTrait
{
    protected $factoryTestService;

    public function getFactoryTestService()
    {
        return $this->factoryTestService;
    }

    public function setFactoryTestService($factoryService)
    {
        $this->factoryTestService = $factoryService;
        return $this;
    }
}
