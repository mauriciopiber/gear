<?php
namespace Gear\Diagnostic;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AntServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Diagnostic\AntService(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearBase\Util\String')
        );
    }
}
