<?php
namespace Gear\Mvc\Spec\Step;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Spec\Step\Step;

class StepFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Step(
        );
        unset($serviceLocator);
        return $factory;
    }
}
