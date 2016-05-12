<?php
namespace Gear\Diagnostic;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DirServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Diagnostic\DirService(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearBase\Util\String')
        );
    }
}
