<?php
namespace Gear\Mvc;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\TraitTestService;
use Gear\Creator\FileCreator\FileCreator;

class TraitTestServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new TraitTestService(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get(FileCreator::class),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('Gear\Creator\CodeTest')
        );
        unset($serviceLocator);
        return $factory;
    }
}