<?php
namespace Gear\Diagnostic\Npm;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\Npm\NpmService;

class NpmServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new NpmService(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get('Gear\Edge\Npm\NpmEdge')
        );
        unset($serviceLocator);
        return $factory;
    }
}
