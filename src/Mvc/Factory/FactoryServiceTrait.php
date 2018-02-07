<?php
namespace Gear\Mvc\Factory;

use Gear\Mvc\Factory\FactoryService;

trait FactoryServiceTrait
{
    protected $factoryService;

    public function getFactoryService()
    {
        if (!isset($this->factoryService)) {
            $this->factoryService = $this->getServiceLocator()->get(FactoryService::class);
        }
        return $this->factoryService;
    }

    public function setFactoryService(FactoryService $factoryService)
    {
        $this->factoryService = $factoryService;
        return $this;
    }
}