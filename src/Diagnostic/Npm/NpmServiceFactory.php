<?php
namespace Gear\Diagnostic\Npm;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\Npm\NpmService;
use Gear\Module\Structure\ModuleStructure;

class NpmServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new NpmService(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get('Gear\Edge\Npm\NpmEdge')
        );
        unset($serviceLocator);
        return $factory;
    }
}
