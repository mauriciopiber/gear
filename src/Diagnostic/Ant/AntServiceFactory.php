<?php
namespace Gear\Diagnostic\Ant;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Edge\Ant\AntEdge;

class AntServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Diagnostic\Ant\AntService(
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get(AntEdge::class)
        );
    }
}
