<?php
namespace Gear\Diagnostic\Dir;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\Dir\DirService;
use Gear\Edge\Dir\DirEdge;
use Gear\Module\Structure\ModuleStructure;

class DirServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DirService(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get(DirEdge::class)
        );
    }
}
