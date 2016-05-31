<?php
namespace Gear\Mvc;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\TraitTestService;

class TraitTestServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new TraitTestService(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('Gear\FileCreator'),
            $serviceLocator->get('GearBase\Util\String')
        );
        unset($serviceLocator);
        return $factory;
    }
}
